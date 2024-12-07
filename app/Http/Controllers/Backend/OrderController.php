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


class OrderController extends Controller
{
    //
    public function CompleteOrder(Request $request)
    {
        if ($request->customers_id == 'Walk-in-Customer') {
            $customer = new Customer();
            $customer->customerName = 'Walk-in Customer';
            $customer->customerEmail = 'walkin@example.com';
            $customer->customerPhone = '0000000000';
            $customer->customerAddress = 'N/A';
            $customer->save();

            $customerID = $customer->id; // This is the correct ID to use
        } else {
            $customerID = $request->customers_id; // This should be an integer
        }

        $order = [
            'customers_id' => $customerID, // Use $customerID here
            'orderDate' => Carbon::createFromFormat('d-F-Y', $request->orderDate)->format('Y-m-d H:i:s'), // Ensure correct date format
            'orderStatus' => $request->orderStatus,
            'totalProducts' => $request->totalProducts,
            'subTotal' => $request->subTotal,
            'vat' => $request->vat,
            'invoice_no' => 'EPOS' . mt_rand(100000, 999999),
            'total' => $request->total,
            'payment_status' => $request->payment_status,
            'pay' => $request->pay,
            'due' => $request->due,
            'created_at' => Carbon::now(),
        ];

        $orders_id = Order::insertGetId($order);
        $contents = Cart::content();

        foreach ($contents as $content) {
            $productData = [
                'orders_id' => $orders_id,
                'products_id' => $content->id,
                'quantity' => $content->qty,
                'unitCost' => $content->price,
                'totalCost' => $content->price * $content->qty,
            ];
            OrderDetails::insert($productData);
        }

        $notification = [
            'message' => 'Order Created Successfully',
            'alert-type' => 'success'
        ];

        Cart::destroy();

        return redirect()->route('pos')->with($notification);
    } //end method CompleteOrder

    public function UnpaidOrder()
    {
        $orders = Order::where('orderStatus', 'Unpaid')->get();
        return view('backend.order.pending_order', compact('orders'));
    } //end method UnpaidOrder

    public function OrderDetails($orders_id)
    {
        $order = Order::where('id', $orders_id)->first();
        $orderItem = OrderDetails::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_details', compact('order', 'orderItem'));
    } // End Method 

    public function OrderStatusUpdate(Request $request)
    {
        $order_id = $request->id;

        $product = OrderDetails::where('orders_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->products_id)
                ->update(['productStock' => DB::raw('productStock-' . $item->quantity)]);
        }

        Order::findOrFail($order_id)->update(['orderStatus' => 'complete']);

        $notification = array(
            'message' => 'Order Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unpaid.order')->with($notification);
    } // End Method

    public function PaidOrder()
    {
        $orders = Order::where('orderStatus', 'PAID')->get();
        return view('backend.order.paid_order', compact('orders'));
    } //end method PaidOrder
    public function StockManage()
    {
        $products = Product::latest()->get();
        return view('backend.stock.all_stock', compact('products'));
    } // End Method 

} //end class OrderController
