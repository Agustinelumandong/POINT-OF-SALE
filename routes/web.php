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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

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
        Route::get('/edit/employee{id}', action: 'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('update.employee');
        Route::get('/delete/employee{id}', action: 'DeleteEmployee')->name('delete.employee');
        Route::get('/show/deleted/employee', action: 'ShowDeletedEmployee')->name('show.deleted.employee');
        Route::get('/restore/employee{id}', action: 'RestoreEmployee')->name('restore.employee');
        Route::get('/delete/permanently/employee{id}', action: 'DeletePermanentlyEmployee')->name('delete.permanently.employee');
    }); //end Route::controller(), Group


    // Customer All Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
        Route::get('/edit/customer{id}', action: 'EditCustomer')->name('edit.customer');
        Route::post('/update/customer', 'UpdateCustomer')->name('update.customer');
        Route::get('/delete/customer{id}', action: 'DeleteCustomer')->name('delete.customer');
        Route::get('/show/deleted/customer', action: 'ShowDeletedCustomer')->name('show.deleted.customer');
        Route::get('/restore/customer{id}', action: 'RestoreCustomer')->name('restore.customer');
        Route::get('/delete/permanently/customer{id}', action: 'DeletePermanentlyCustomer')->name('delete.permanently.customer');
    }); //end Route::controller(), Group


    // Supplier All Route
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'StoreSupplier')->name('store.supplier');
        Route::get('/edit/supplier{id}', action: 'EditSupplier')->name('edit.supplier');
        Route::post('/update/supplier', 'UpdateSupplier')->name('update.supplier');
        Route::get('/delete/supplier{id}', action: 'DeleteSupplier')->name('delete.supplier');
        Route::get('/show/deleted/supplier', action: 'ShowDeletedSupplier')->name('show.deleted.supplier');
        Route::get('/restore/supplier{id}', action: 'RestoreSupplier')->name('restore.supplier');
        Route::get('/delete/permanently/supplier{id}', action: 'DeletePermanentlySupplier')->name('delete.permanently.supplier');
        Route::get('/details/supplier{id}', action: 'DetailsSupplier')->name('details.supplier');
    }); //end Route::controller(), Group

    // Product Category All Route
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/all/product/category', 'AllProductCategory')->name('all.productCategory');
        Route::get('/add/product/category', 'AddProductCategory')->name('add.productCategory');
        Route::post('/store/product/category', 'StoreProductCategory')->name('store.productCategory');
        Route::get('/edit/product/category{id}', action: 'EditProductCategory')->name('edit.productCategory');
        Route::post('/update/product/category', 'UpdateProductCategory')->name('update.productCategory');
        Route::get('/delete/product/category{id}', action: 'DeleteProductCategory')->name('delete.productCategory');
        Route::get('/show/deleted/product/category', action: 'ShowDeletedProductCategory')->name('show.deleted.productCategory');
        Route::get('/restore/product/category{id}', action: 'RestoreProductCategory')->name('restore.productCategory');
        Route::get('/delete/permanently/product/category{id}', action: 'DeletePermanentlyProductCategory')->name('delete.permanently.productCategory');
    }); //end Route::controller(), Group

    // Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product{id}', action: 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::get('/delete/product{id}', action: 'DeleteProduct')->name('delete.product');
        Route::get('/show/deleted/product', action: 'ShowDeletedProduct')->name('show.deleted.product');
        Route::get('/restore/product{id}', action: 'RestoreProduct')->name('restore.product');
        Route::get('/delete/permanently/product{id}', action: 'DeletePermanentlyProduct')->name('delete.permanently.product');
    }); //end Route::controller(), Group

}); //end Route::middleware(), Group
