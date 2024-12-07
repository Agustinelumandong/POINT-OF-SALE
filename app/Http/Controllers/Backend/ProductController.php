<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    // All Product
    public function AllProduct()
    {
        $product = Product::latest()->get();

        return view("backend.product.all_product", compact("product"));
    } //end method AllProduct

    public function AddProduct()
    {
        $productCategory = ProductCategory::latest()->get();
        $productSupplier = Supplier::latest()->get();
        return view("backend.product.add_product", compact("productCategory", "productSupplier"));
    } //end method AddProduct

    public function StoreProduct(Request $request)
    {

        // Function to generate a unique product code
        function generateProductCode()
        {
            return rand(10000000, 99999999); // Generates an 8-digit random number
        }

        // Ensure uniqueness
        do {
            $productCode = generateProductCode();
        } while (Product::where('productCode', $productCode)->exists());

        if ($request->file('productImage')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('productImage')->getClientOriginalExtension();
            $img = $manager->read($request->file('productImage'));
            $img->resize(300, 300);

            $img->toJpeg(80)->save(base_path("public/upload/product_image/{$name_gen}"));
            $save_url = "upload/product_image/{$name_gen}";

            Product::create([
                'productName' => $request->productName,
                'categoryID' => $request->categoryID,
                'supplierID' => $request->supplierID,
                'productCode' => $productCode,
                'productImage' => $save_url,
                'buyingDate' => $request->buyingDate,
                'expireDate' => $request->expireDate,
                'buyingPrice' => $request->buyingPrice,
                'sellingPrice' => $request->sellingPrice,
                'created_at' => Carbon::now(),
            ]);
        } //end if

        $notification = [
            'message' => 'Product Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        $productCategory = ProductCategory::latest()->get();
        $productSupplier = Supplier::latest()->get();
        return view("backend.product.edit_product", compact("product", "productCategory", "productSupplier"));
    } //end method EditProduct

    public function UpdateProduct(Request $request)
    {


        $productID = $request->id;

        // Find the product record
        $product = Product::findOrFail($productID);

        // Check if a new image is being uploaded
        if ($request->file('productImage')) {
            // Get the current image path
            $oldImagePath = public_path($product->productImage);

            // Delete the old image if it exists
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Process the new image
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('productImage')->getClientOriginalExtension();
            $img = $manager->read($request->file('productImage'));
            $img->resize(300, 300);
            $img->toJpeg(80)->save(base_path("public/upload/product_image/{$name_gen}"));
            $save_url = "upload/product_image/{$name_gen}";

            // Update the product record with the new image
            $product->update([
                'productName' => $request->productName,
                'categoryID' => $request->categoryID,
                'supplierID' => $request->supplierID,
                // 'productCode' => $request->productCode,
                'productImage' => $save_url,
                'buyingDate' => $request->buyingDate,
                'expireDate' => $request->expireDate,
                'buyingPrice' => $request->buyingPrice,
                'sellingPrice' => $request->sellingPrice,
                'created_at' => Carbon::now(),
            ]);
        } else {
            // If no new image, just update other fields
            $product->update([
                'productName' => $request->productName,
                'categoryID' => $request->categoryID,
                'supplierID' => $request->supplierID,
                // 'productCode' => $request->productCode,
                'buyingDate' => $request->buyingDate,
                'expireDate' => $request->expireDate,
                'buyingPrice' => $request->buyingPrice,
                'sellingPrice' => $request->sellingPrice,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    } //end method UpdateProduct

    public function DeleteProduct($id)
    {
        // Find the product record
        $product = Product::findOrFail($id);

        // Get the image path
        $img = public_path($product->productImage);

        // Move the image to the deleted pictures folder
        $deletedImgDir = public_path('upload/deleted_product_image');
        if (!file_exists($deletedImgDir)) {
            mkdir($deletedImgDir, 0755, true);
        }

        if (file_exists($img)) {
            $deletedImgPath = $deletedImgDir . '/' . basename($img);
            rename($img, $deletedImgPath);
        }

        // Soft delete the product record
        $product->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method DeleteProduct


    public function ShowDeletedProduct()
    {
        $deletedProducts = Product::onlyTrashed()->latest()->get();
        foreach ($deletedProducts as $product) {
            // Construct the URL for the deleted image
            $product->deletedImagePath = asset('upload/deleted_product_image/' . basename($product->productImage));
        }
        return view("backend.product.show_deleted_product", compact("deletedProducts"));
    } //end method ShowDeletedProduct


    public function RestoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        // Define paths
        $deletedImgPath = public_path('upload/deleted_product_image/' . basename($product->productImage));
        $originalImgPath = public_path('upload/product_image/' . basename($product->productImage));

        // Check if the original directory exists, if not, create it
        $originalImgDir = public_path('upload/product_image');
        if (!file_exists($originalImgDir)) {
            mkdir($originalImgDir, 0755, true);
        }

        // Move the image back to the original folder
        if (file_exists($deletedImgPath)) {
            rename($deletedImgPath, $originalImgPath);
        }

        $notification = [
            'message' => 'Product Restored Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.product')->with($notification);
    } //end method RestoreProduct

    public function DeletePermanentlyProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $img = public_path('upload/deleted_product_image/' . basename($product->productImage));

        // Delete the image from the deleted folder if it exists
        if (file_exists($img)) {
            unlink($img);
        }

        // Permanently delete the product record
        $product->forceDelete();

        $notification = [
            'message' => 'Product Permanently Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.product')->with($notification);
    } //end method DeletePermanentlyProduct

    public function BarcodeProduct($id)
    {
        $product = Product::findOrFail($id);
        return view("backend.product.barcode_product", compact("product"));
    } //end method BarcodeProduct

    public function ImportProductPage()
    {
        return view("backend.product.import_product");
    } //end method ImportProduct
    public function ExportProduct()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    } //end method ImportProduct

    public function ImportProduct(Request $request)
    {
        Excel::import(new ProductImport, $request->file('importProduct'));

        $notification = [
            'message' => 'Product Imported Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method ImportProduct

}
