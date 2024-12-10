<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    //
    public function CompleteOrder(Request $request)
    {
        $requestTotal = $request->total;
        $requestPay = $request->pay;

        // Check if the customer is a walk-in customer
        if ($request->customers_id == 'Walk-in-Customer') {
            // Create a new walk-in customer
            $customer = new Customer();
            $customer->customerName = 'Walk-in Customer';
            $customer->customerEmail = 'walkin@example.com';
            $customer->customerPhone = '0000000000';
            $customer->customerAddress = 'N/A';
            $customer->save();

            $customerID = $customer->id;

            // Handle payment for walk-in customer
            if ($requestPay < $requestTotal) {
                // If payment is less than total, throw an error
                return redirect()->back()->withErrors(['pay' => 'Payment must be equal to or greater than the total for walk-in customers.']);
            } else {
                // Calculate change for walk-in customer
                $change = $requestPay - $requestTotal;
                $orderStatus = 'Complete'; // Walk-in customers with full payment are always Complete
            }
        } else {
            // For registered customers
            $customerID = $request->customers_id;
            // Calculate due amount
            $dueTotal = $requestTotal - $requestPay;

            // Set order status based on payment
            if ($requestPay >= $requestTotal) {
                $change = $requestPay - $requestTotal;
                $orderStatus = 'Complete';
                $dueTotal = 0; // No due amount if paid in full
            } else {
                $orderStatus = 'Pending'; // Set to pending if there's a remaining balance
                $change = 0;
            }
        }

        // Check product stock before creating the order
        $contents = Cart::content();
        foreach ($contents as $content) {
            $productStock = Product::where('id', $content->id)->value('productStock');

            // Check if the stock is less than 0
            if ($productStock < 0) {
                $notification = [
                    'message' => 'This product ' . $content->name . ' is out of stock',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->withErrors(['stock' => 'Product ID ' . $content->id . ' is out of stock. Cannot place order.']);
            }

            // Check if the requested quantity is greater than available stock
            if ($content->qty > $productStock) {
                $notification = [
                    'message' => 'Not enough stock for product ' . $content->name,
                    'alert-type' => 'error'
                ];
                return redirect()->back()->withErrors(['stock' => 'Not enough stock for product ID ' . $content->id])->with($notification);
            }
        }

        // Prepare order data
        $order = [
            'customers_id' => $customerID,
            'orderDate' => Carbon::createFromFormat('d-F-Y', $request->orderDate)->format('Y-m-d H:i:s'),
            'orderStatus' => $orderStatus, // Use the dynamically set status
            'totalProducts' => $request->totalProducts,
            'subTotal' => $request->subTotal,
            'vat' => $request->vat,
            'invoice_no' => $request->invoice_no,
            'total' => $request->total,
            'payment_status' => $request->payment_status,
            'pay' => $request->pay,
            'due' => $dueTotal ?? 0,
            'created_at' => Carbon::now(),
        ];

        // Insert order and get the order ID
        $orders_id = Order::insertGetId($order);

        // Insert order details and update product stock
        foreach ($contents as $content) {
            $productData = [
                'orders_id' => $orders_id,
                'products_id' => $content->id,
                'quantity' => $content->qty,
                'unitCost' => $content->price,
                'totalCost' => $content->price * $content->qty,
            ];
            OrderDetails::insert($productData);

            // Update product stock
            Product::where('id', $content->id)
                ->update(['productStock' => DB::raw('productStock - ' . $content->qty)]);
        }

        // Check for low stock notification
        foreach ($contents as $content) {
            $productStock = Product::where('id', $content->id)->value('productStock');
            if ($productStock < 20) {
                // You can implement your notification logic here
                session()->flash('low_stock_notification', value: 'Product ID ' . $content->id . ' is low on stock: ' . $productStock . ' remaining.');
            }
        }

        // Prepare notification message
        $notification = [
            'message' => 'Order Created Successfully' .
                (isset($change) && $change > 0 ? " Change: $" . number_format($change, 2) : "") .
                ($dueTotal ?? 0 > 0 ? " Due Amount: $" . number_format($dueTotal, 2) : ""),
            'alert-type' => 'success'
        ];

        // Clear the cart
        Cart::destroy();

        // Redirect with notification
        return redirect()->route('pos')->with($notification);
    } // End Method

    public function UnpaidOrder()
    {
        $orders = Order::where('orderStatus', 'Pending')->get();
        return view('backend.order.pending_order', compact('orders'));
    } //end method UnpaidOrder

    public function OrderDetails(Request $request, $orders_id)
    {

        $order = Order::where('id', $orders_id)->first();
        $orders = Order::findOrFail($orders_id);

        $orderItem = OrderDetails::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_details', compact('order', 'orderItem', 'orders'));
    } // End Method 

    public function OrderStatusUpdate(Request $request)
    {
        // Validate the request
        $request->validate([
            'payment_status' => 'required',
            'pay' => 'required|numeric|min:0',
        ]);

        // Get the order ID from the hidden input or route parameter
        $orders_id = $request->id;

        // Find the order
        $order = Order::findOrFail($orders_id);

        // Calculate payment and change
        $payment_amount = $request->pay;
        $due_amount = $order->due;
        $pay_amount = $order->pay;
        $change_amount = $payment_amount + $due_amount;

        $total_amount_pay = $payment_amount + $pay_amount;

        // Check if payment is sufficient
        if ($change_amount < 0) {
            return back()->with([
                'message' => 'Payment amount must be at least equal to the due amount',
                'alert-type' => 'error'
            ]);
        }

        // Check product stock
        $product = OrderDetails::where('orders_id', $orders_id)->get();
        foreach ($product as $item) {
            $productStock = Product::where('id', $item->products_id)->value('productStock');

            // Check if the requested quantity is greater than available stock
            if ($item->quantity > $productStock) {
                return back()->with([
                    'message' => 'Not enough stock for product ID ' . $item->products_id,
                    'alert-type' => 'error'
                ]);
            }
        }

        // Update product stock
        foreach ($product as $item) {
            Product::where('id', $item->products_id)
                ->update(['productStock' => DB::raw('productStock-' . $item->quantity)]);
        }

        // Update order status and payment details
        $order->update([
            'orderStatus' => 'Complete',
            'payment_status' => $request->payment_status,
            'pay' => $total_amount_pay, // Store the actual payment amount, not including change
            'due' => 0,
            // 'payment_date' => now(),
        ]);

        // Check for low stock notification
        foreach ($product as $item) {
            $productStock = Product::where('id', $item->products_id)->value('productStock');
            if ($productStock < 20) {
                // You can implement your notification logic here
                // For example, you can log it, send an email, or store it in a session
                session()->flash('low_stock_notification', 'Product ID ' . $item->products_id . ' is low on stock: ' . $productStock . ' remaining.');
            }
        }

        $notification = array(
            'message' => 'Order Completed and Payment Processed Successfully. Change Amount: $' . number_format($change_amount, 2),
            'alert-type' => 'success'
        );

        return redirect()->route('unpaid.order')->with($notification);
    } // End Method

    public function PaidOrder()
    {
        $orders = Order::where('orderStatus', 'Complete')->get();
        return view('backend.order.paid_order', compact('orders'));
    } //end method PaidOrder



    public function OrderInvoice($orders_id)
    {
        // Fetch the order using the provided order ID
        $order = Order::where('id', $orders_id)->first();

        // Fetch the order items related to the order
        $orderItem = OrderDetails::with('product') // Corrected the relation syntax
            ->where('orders_id', $orders_id)
            ->orderBy('id', 'DESC')
            ->get();

        // Load the view for the invoice and set options for the PDF
        $pdf = Pdf::loadView('backend.order.order_invoice', compact('order', 'orderItem'))
            ->setPaper([0, 0, 226.77, 600])  // 80mm width × 211mm height
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

        // Download the PDF file
        return $pdf->download('invoice_' . $order->id . '.pdf');
    } // End Method



} //end class OrderController
