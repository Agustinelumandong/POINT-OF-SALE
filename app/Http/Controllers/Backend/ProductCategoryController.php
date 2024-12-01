<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductCategoryController extends Controller
{
    public function AllProductCategory()
    {
        $productCategory = ProductCategory::latest()->get();
        return view("backend.productCategory.all_productCategory", compact("productCategory"));
    } //end method AllProductCategory

    public function AddProductCategory()
    {
        return view("backend.productCategory.add_productCategory");
    } //end method AddProductCategory

    public function StoreProductCategory(Request $request)
    {
        $validateData = $request->validate([
            'productCategoryName' => 'required|max:255'
        ]);

        ProductCategory::create([
            'productCategoryName' => $request->productCategoryName,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'ProductCategory Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.productCategory')->with($notification);
    } //end method StoreProductCategory

    public function EditProductCategory($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view("backend.productCategory.edit_productCategory", compact("productCategory"));
    } //end method EditProductCategory


    public function UpdateProductCategory(Request $request)
    {
        $productCategory_id = $request->id;

        // Find the productCategory record
        $productCategory = ProductCategory::findOrFail($productCategory_id);

        $productCategory->update([
            'productCategoryName' => $request->productCategoryName,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'ProductCategory Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.productCategory')->with($notification);
    } //end method UpdateProductCategory


    public function DeleteProductCategory($id)
    {
        // Find the productCategory record
        $productCategory = ProductCategory::findOrFail($id);

        // Soft delete the productCategory record
        $productCategory->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'ProductCategory Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method DeleteProductCategory

    public function ShowDeletedProductCategory()
    {
        $deletedProductCategory = ProductCategory::onlyTrashed()->latest()->get();

        return view("backend.productCategory.show_deleted_productCategory", compact("deletedProductCategory"));
    } //end method ShowDeletedProductCategory

    public function RestoreProductCategory($id)
    {
        $productCategory = ProductCategory::withTrashed()->findOrFail($id);
        $productCategory->restore();

        $notification = [
            'message' => 'ProductCategory Restored Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.productCategory')->with($notification);
    } //end method RestoreProductCategory

    public function DeletePermanentlyProductCategory($id)
    {
        $productCategory = ProductCategory::withTrashed()->findOrFail($id);

        // Permanently delete the productCategory record
        $productCategory->forceDelete();

        $notification = [
            'message' => 'ProductCategory Permanently Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.productCategory')->with($notification);
    } //end method DeletePermanentlyProductCategory

    public function DetailsProductCategory($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view("backend.productCategory.show_details_productCategory", compact("productCategory"));
    } //end method EditProductCategory



}
