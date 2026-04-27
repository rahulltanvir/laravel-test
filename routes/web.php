<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;

Route::get('/', [MyCommerceController::class, 'index'])->name('home');
route::get('/product-category', [MyCommerceController::class, 'category'])->name('product-category');
route::get('/product-detail', [MyCommerceController::class, 'detail'])->name('product-detail');