<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\Cardcontroller;
use App\Http\Controllers\CheckoutController;

Route::get('/', [MyCommerceController::class, 'index'])->name('home');
route::get('/product-category', [MyCommerceController::class, 'category'])->name('product-category');
route::get('/product-detail', [MyCommerceController::class, 'detail'])->name('product-detail');
route::get('/show-card', [Cardcontroller::class, 'index'])->name('show-card');
route::get('/check-out', [CheckoutController::class, 'index'])->name('check-out');
