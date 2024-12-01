<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Carbon\Carbon;

class CustomerController extends Controller
{
    //
    public function AllCustomer()
    {
        $customer = Customer::latest()->get();
        return view("backend.customer.all_customer", compact("customer"));
    } //end method AllCustomer

    public function AddCustomer()
    {
        return view("backend.customer.add_customer");
    } //end method AddCustomer

    public function StoreCustomer(Request $request)
    {
        $validateData = $request->validate([
            'customerName' => 'required|max:255',
            'customerEmail' => 'required|unique:customers|max:255',
            'customerPhone' => 'required|max:255',
            'customerAddress' => 'required|max:255'
        ]);

        Customer::create([
            'customerName' => $request->customerName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Customer Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.customer')->with($notification);
    } //end method StoreCustomer

    public function EditCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view("backend.customer.edit_customer", compact("customer"));
    } //end method EditCustomer


    public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;

        // Find the customer record
        $customer = Customer::findOrFail($customer_id);

        $customer->update([
            'customerName' => $request->customerName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.customer')->with($notification);
    } //end method UpdateCustomer


    public function DeleteCustomer($id)
    {
        // Find the customer record
        $customer = Customer::findOrFail($id);

        // Soft delete the customer record
        $customer->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method DeleteCustomer

    public function ShowDeletedCustomer()
    {
        $deletedCustomers = Customer::onlyTrashed()->latest()->get();

        return view("backend.customer.show_deleted_customer", compact("deletedCustomers"));
    } //end method ShowDeletedCustomer

    public function RestoreCustomer($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->restore();

        $notification = [
            'message' => 'Customer Restored Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.customer')->with($notification);
    } //end method RestoreCustomer

    public function DeletePermanentlyCustomer($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);

        // Permanently delete the customer record
        $customer->forceDelete();

        $notification = [
            'message' => 'Customer Permanently Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.customer')->with($notification);
    } //end method DeletePermanentlyCustomer


}
