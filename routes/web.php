<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\Cardcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerAuthController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UnitController;
//frontend
Route::get('/', [MyCommerceController::class, 'index'])->name('home');
Route::get('/product-category/{id}', [MyCommerceController::class, 'category'])->name('product-category');
Route::get('/product-subcategory/{id}', [MyCommerceController::class, 'subcategory'])->name('product-subcategory');
Route::get('/product-detail/{id}', [MyCommerceController::class, 'detail'])->name('product-detail');
Route::post('/add-to-cart/{id}', [Cardcontroller::class, 'index'])->name('add-to-cart');
Route::get('/cart', [Cardcontroller::class, 'show'])->name('cart');
Route::post('/update-cart-qty', [Cardcontroller::class, 'updateQty'])->name('update-cart-qty');
Route::post('/remove-from-cart', [Cardcontroller::class, 'remove'])->name('remove-from-cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('check-out');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('check-out-store');
Route::get('/success', function () {
    return view('website.checkout.success');
})->name('success');

//customer

// SHOW LOGIN PAGE
Route::get('/customer/login', [CustomerAuthController::class, 'loginForm'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class, 'registerForm'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.post');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.post');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/manage', [CategoryController::class, 'manage'])->name('category.manage');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    //sub category
    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategory/manage', [SubcategoryController::class, 'manage'])->name('subcategory.manage');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');

    //Brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/manage', [BrandController::class, 'manage'])->name('brand.manage');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');

    //unit
    Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/manage', [UnitController::class, 'manage'])->name('unit.manage');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/delete/{id}', [UnitController::class, 'destroy'])->name('unit.delete');

    //Product

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/get-subcategories/{id}', [ProductController::class, 'getSubcategory'])
        ->name('product.get-subcategories');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/manage', [ProductController::class, 'manage'])->name('product.manage');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get(
        '/admin/order/cancel/{id}',
        [OrderController::class, 'cancelOrder']
    )->name('admin.order.cancel');
    Route::get(
        '/admin/payment/approve/{id}',
        [OrderController::class, 'approvePayment']
    )->name('admin.payment.approve');
    Route::get('/order/details/{id}', [OrderController::class, 'show'])->name('admin.order.details');
    Route::get('/admin/order-confirm/{id}', [OrderController::class, 'confirmOrder'])->name('admin.order.confirm');
    Route::get('/admin/invoice/{id}', [OrderController::class, 'invoice'])->name('admin.invoice');
});
