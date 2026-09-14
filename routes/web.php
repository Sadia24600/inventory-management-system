<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/addcategory',[AdminController::class,'addCategory'])->name('admin.addcategory');
    Route::post('/addcategory',[AdminController::class,'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/viewcategory',[AdminController::class,'viewCategory'])->name('admin.viewcategory');
    Route::get('/deletecategory/{id}',[AdminController::class,'deleteCategory'])->name('admin.deletecategory');
    Route::get('/updatecategory/{id}',[AdminController::class,'updateCategory'])->name('admin.updatecategory');
    Route::post('/updatecategory/{id}',[AdminController::class,'postUpdateCategory'])->name('admin.postupdatecategory');

    Route::get('/addsupplier',[AdminController::class,'addSupplier'])->name('admin.addsupplier');
    Route::post('/addsupplier',[AdminController::class,'postAddSupplier'])->name('admin.postaddsupplier');
    Route::get('/viewsupplier',[AdminController::class,'viewSupplier'])->name('admin.viewsupplier');
    Route::get('/deletesupplier/{id}',[AdminController::class,'deleteSupplier'])->name('admin.deletesupplier');
    Route::get('/updatesupplier/{id}',[AdminController::class,'updateSupplier'])->name('admin.updatesupplier');
    Route::post('/updatesupplier/{id}',[AdminController::class,'postUpdateSupplier'])->name('admin.postupdatesupplier');

    Route::get('/addproduct',[AdminController::class,'addProduct'])->name('admin.addproduct');
    Route::post('/addproduct',[AdminController::class,'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/viewproduct',[AdminController::class,'viewProduct'])->name('admin.viewproduct');
    Route::get('/deleteproduct/{id}',[AdminController::class,'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/updateproduct/{id}',[AdminController::class,'updateProduct'])->name('admin.updateproduct');
    Route::post('/updateproduct/{id}',[AdminController::class,'postUpdateProduct'])->name('admin.postupdateproduct');

    Route::get('/orders',[AdminController::class,'viewOrders'])->name('admin.vieworders');
    Route::get('/orders/{id}', [AdminController::class, 'postOrders'])->name('admin.postorder');
    Route::post('/updatequantity/{id}',[AdminController::class,'updateQuantity'])->name('admin.updatequantity');
     Route::get('/removeorder/{id}', [AdminController::class, 'RemoveOrder'])->name('admin.removeorder');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
