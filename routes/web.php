<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PosController;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\EmployeesController;
// use ;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $sales = App\Models\Order::all();
    return view('index', compact('sales'));
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');

    // Employee All Route
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/all/employee', 'AllEmployee')->name('all.employee');
        Route::get('/add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('store.employee');
        Route::get('/edit/employee{id}',  'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('update.employee');
        Route::get('/delete/employee{id}',  'DeleteEmployee')->name('delete.employee');
        Route::get('/show/deleted/employee',  'ShowDeletedEmployee')->name('show.deleted.employee');
        Route::get('/restore/employee{id}',  'RestoreEmployee')->name('restore.employee');
        Route::get('/delete/permanently/employee{id}',  'DeletePermanentlyEmployee')->name('delete.permanently.employee');
    }); //end Route::controller(), Group


    // Customer All Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
        Route::get('/edit/customer{id}',  'EditCustomer')->name('edit.customer');
        Route::post('/update/customer', 'UpdateCustomer')->name('update.customer');
        Route::get('/delete/customer{id}',  'DeleteCustomer')->name('delete.customer');
        Route::get('/show/deleted/customer',  'ShowDeletedCustomer')->name('show.deleted.customer');
        Route::get('/restore/customer{id}',  'RestoreCustomer')->name('restore.customer');
        Route::get('/delete/permanently/customer{id}',  'DeletePermanentlyCustomer')->name('delete.permanently.customer');
    }); //end Route::controller(), Group


    // Supplier All Route
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'StoreSupplier')->name('store.supplier');
        Route::get('/edit/supplier{id}',  'EditSupplier')->name('edit.supplier');
        Route::post('/update/supplier', 'UpdateSupplier')->name('update.supplier');
        Route::get('/delete/supplier{id}',  'DeleteSupplier')->name('delete.supplier');
        Route::get('/show/deleted/supplier',  'ShowDeletedSupplier')->name('show.deleted.supplier');
        Route::get('/restore/supplier{id}',  'RestoreSupplier')->name('restore.supplier');
        Route::get('/delete/permanently/supplier{id}',  'DeletePermanentlySupplier')->name('delete.permanently.supplier');
        Route::get('/details/supplier{id}',  'DetailsSupplier')->name('details.supplier');
    }); //end Route::controller(), Group


    // Product Category All Route
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/all/product/category', 'AllProductCategory')->name('all.productCategory');
        Route::get('/add/product/category', 'AddProductCategory')->name('add.productCategory');
        Route::post('/store/product/category', 'StoreProductCategory')->name('store.productCategory');
        Route::get('/edit/product/category{id}',  'EditProductCategory')->name('edit.productCategory');
        Route::post('/update/product/category', 'UpdateProductCategory')->name('update.productCategory');
        Route::get('/delete/product/category{id}',  'DeleteProductCategory')->name('delete.productCategory');
        Route::get('/show/deleted/product/category',  'ShowDeletedProductCategory')->name('show.deleted.productCategory');
        Route::get('/restore/product/category{id}',  'RestoreProductCategory')->name('restore.productCategory');
        Route::get('/delete/permanently/product/category{id}',  'DeletePermanentlyProductCategory')->name('delete.permanently.productCategory');
    }); //end Route::controller(), Group


    // Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product{id}',  'EditProduct')->name('edit.product');
        Route::get('/barcode/product{id}',  'BarcodeProduct')->name('barcode.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::get('/delete/product{id}',  'DeleteProduct')->name('delete.product');
        Route::get('/show/deleted/product',  'ShowDeletedProduct')->name('show.deleted.product');
        Route::get('/restore/product{id}',  'RestoreProduct')->name('restore.product');
        Route::get('/delete/permanently/product{id}',  'DeletePermanentlyProduct')->name('delete.permanently.product');
        Route::get('/import/product/page',  'ImportProductPage')->name('import.product.page');
        Route::get('/export',  'ExportProduct')->name('export.product');
        Route::post('/import',  'ImportProduct')->name('import.product');

        Route::get('/stock', 'StockManage')->name('stock.manage');
        Route::get('/product-stock/{id}', 'UpdateStockAjax');
        Route::post('/update-stock', 'UpdateStock')->name('update.stock');

        Route::get('/notifications', 'Notification');
    }); //end Route::controller(), Group


    // Product Category All Route
    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/add/expense', 'AddExpense')->name('add.expense');
        Route::post('/store/expense', 'StoreExpense')->name('store.expense');
        Route::get('/today/expense', 'TodayExpense')->name('today.expense');
        Route::get('/edit/expense{id}', 'EditExpense')->name('edit.expense');
        Route::post('/update/expense', 'UpdateExpense')->name('update.expense');
        Route::get('/month/expense', 'MonthExpense')->name('month.expense');
        Route::get('/year/expense', 'YearExpense')->name('year.expense');
    }); //end Route::controller(), Group

    // POS Route
    Route::controller(PosController::class)->group(function () {
        Route::get('/pos', 'Pos')->name('pos');
        Route::post('/add-cart', 'AddCart');
        Route::get('/allitem', 'AllItem');
        Route::post('/cart-update/{rowId}', 'CartUpdate');
        Route::get('/cart-remove/{rowId}', 'CartRemove');
        Route::post('/create-invoice', 'CreateInvoice');
        // Route::post('/cart-destroy', 'CartDestroy');
        Route::post('/cart-destroy/{rowId}', 'CartDestroy');
    }); //end Route::controller(), Group

    // Order Route
    Route::controller(OrderController::class)->group(function () {
        Route::post('/complete-order', 'CompleteOrder')->name('complete.order');
        Route::get('/pending-order', 'UnpaidOrder')->name('unpaid.order');
        Route::get('/paid-order', 'PaidOrder')->name('paid.order');

        Route::get('/order/details/{orders_id}', 'OrderDetails')->name('order.details');
        Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');




        Route::get('/order/invoice-download/{orders_id}', 'OrderInvoice')->name('order.invoice.download'); // Corrected line
    }); //end Route::controller(), Group



    Route::resource('employees', EmployeesController::class);
    Route::get('employee/personal-info/{employeeDetail}', [EmployeeDetailsController::class, 'personalInfo'])->name('employee.personal-info');
}); //end Route::middleware(), Group
