<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    //
    public function Pos()
    {
        // Retrieve all products
        $product = Product::latest()->get();
        $products = Product::all();
        $cartItems = Cart::content();
        // Retrieve all customers
        $customers = Customer::latest()->get();
        $customer = Customer::all();


        // Pass the data to the view
        return view('backend.pos.pos_page', compact('product', 'customers', 'products', 'cartItems', 'customer'));
    }

    public function AddCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'options' => ['size' => 'large']
        ]);

        $notification = [
            'message' => 'Product Added Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function AllItem()
    {
        $cartItems = Cart::content();
        return view('backend.pos.all_item', compact('cartItems'));
    }

    public function CartUpdate(Request $request, $rowId)
    {

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        $notification = array(
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'message' => 'Cart Removed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function CreateInvoice(Request $request)
    {

        if ($request->customerID == 'Walk-in-Customer') {

            $customer = new Customer();
            $customer->customerName = 'Walk-in-Customer';
            $customer->customerEmail = '?';
            $customer->customerPhone = '?';
            $customer->customerAddress = '?';
            $customer->save();

            $customerId = $customer->id;
        } else {
            $customerId = $request->customerID;
        }

        $content = Cart::content();
        $customer = Customer::where('id', $customerId)->first();
        return view('backend.invoice.pos_invoice', compact('content', 'customer'));
    }


    public function RemoveCart($rowId)
    {
        Cart::remove($rowId);
        $notification = [
            'message' => 'Product Removed Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function DecrementQty($rowId)
    {
        $item = Cart::get($rowId);
        if ($item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
            return response()->json(['success' => true, 'message' => 'Product Quantity Decremented Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Product Quantity Must Be Greater Than 1']);
        }
    }

    public function IncrementQty($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty + 1);
        return response()->json(['success' => true, 'message' => 'Product Quantity Incremented Successfully']);
    }

    public function CartDestroy($rowId)
    {
        Cart::destroy($rowId);
        $notification = array(
            'message' => 'All Cart Removed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}
