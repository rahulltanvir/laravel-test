<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\Cardcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;

Route::get('/', [MyCommerceController::class, 'index'])->name('home');
route::get('/product-category', [MyCommerceController::class, 'category'])->name('product-category');
route::get('/product-detail', [MyCommerceController::class, 'detail'])->name('product-detail');
route::get('/show-card', [Cardcontroller::class, 'index'])->name('show-card');
route::get('/check-out', [CheckoutController::class, 'index'])->name('check-out');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
   
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/manage', [CategoryController::class, 'manage'])->name('category.manage');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    //sub category
    
});
