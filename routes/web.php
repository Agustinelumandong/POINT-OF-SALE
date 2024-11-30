<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\EmployeeController;

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
}); //end Route::middleware(), Group
