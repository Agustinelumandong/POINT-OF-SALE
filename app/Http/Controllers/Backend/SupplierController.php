<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;

class SupplierController extends Controller
{
    // All Supplier
    public function AllSupplier()
    {
        $supplier = Supplier::latest()->get();
        return view("backend.supplier.all_supplier", compact("supplier"));
    } //end method AllSupplier

    public function AddSupplier()
    {
        return view("backend.supplier.add_supplier");
    } //end method AddSupplier

    public function StoreSupplier(Request $request)
    {
        $validateData = $request->validate([
            'supplierName' => 'required|max:255',
            'supplierEmail' => 'required|unique:suppliers|max:255',
            'supplierPhone' => 'required|max:255',
            'supplierAddress' => 'required|max:255',
            'supplierType' => 'required'
        ]);

        Supplier::create([
            'supplierName' => $request->supplierName,
            'supplierEmail' => $request->supplierEmail,
            'supplierPhone' => $request->supplierPhone,
            'supplierAddress' => $request->supplierAddress,
            'supplierType' => $request->supplierType,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Supplier Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.supplier')->with($notification);
    } //end method StoreSupplier

    public function EditSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view("backend.supplier.edit_supplier", compact("supplier"));
    } //end method EditSupplier


    public function UpdateSupplier(Request $request)
    {
        $supplier_id = $request->id;

        // Find the supplier record
        $supplier = Supplier::findOrFail($supplier_id);

        $supplier->update([
            'supplierName' => $request->supplierName,
            'supplierEmail' => $request->supplierEmail,
            'supplierPhone' => $request->supplierPhone,
            'supplierAddress' => $request->supplierAddress,
            'supplierType' => $request->supplierType,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.supplier')->with($notification);
    } //end method UpdateSupplier


    public function DeleteSupplier($id)
    {
        // Find the supplier record
        $supplier = Supplier::findOrFail($id);

        // Soft delete the supplier record
        $supplier->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method DeleteSupplier

    public function ShowDeletedSupplier()
    {
        $deletedSuppliers = Supplier::onlyTrashed()->latest()->get();

        return view("backend.supplier.show_deleted_supplier", compact("deletedSuppliers"));
    } //end method ShowDeletedSupplier

    public function RestoreSupplier($id)
    {
        $supplier = Supplier::withTrashed()->findOrFail($id);
        $supplier->restore();

        $notification = [
            'message' => 'Supplier Restored Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.supplier')->with($notification);
    } //end method RestoreSupplier

    public function DeletePermanentlySupplier($id)
    {
        $supplier = Supplier::withTrashed()->findOrFail($id);

        // Permanently delete the supplier record
        $supplier->forceDelete();

        $notification = [
            'message' => 'Supplier Permanently Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.supplier')->with($notification);
    } //end method DeletePermanentlySupplier

    public function DetailsSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view("backend.supplier.show_details_supplier", compact("supplier"));
    } //end method EditSupplier


}
