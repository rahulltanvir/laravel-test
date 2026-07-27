<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\Cardcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UnitController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [MyCommerceController::class, 'index'])
    ->name('home');

// Shop - All Products
Route::get('/shop', [MyCommerceController::class, 'shop'])
    ->name('shop');

// Category
Route::get('/product-category/{id}', [MyCommerceController::class, 'category'])
    ->name('product-category');

// Subcategory
Route::get('/product-subcategory/{id}', [MyCommerceController::class, 'subcategory'])
    ->name('product-subcategory');

// Product Details
Route::get('/product-detail/{id}', [MyCommerceController::class, 'detail'])
    ->name('product-detail');


/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

// Add to Cart
Route::post('/add-to-cart/{id}', [Cardcontroller::class, 'index'])
    ->name('add-to-cart');

// Cart
Route::get('/cart', [Cardcontroller::class, 'show'])
    ->name('cart');

// Update Cart Quantity
Route::post('/update-cart-qty', [Cardcontroller::class, 'updateQty'])
    ->name('update-cart-qty');

// Remove From Cart
Route::post('/remove-from-cart', [Cardcontroller::class, 'remove'])
    ->name('remove-from-cart');


/*
|--------------------------------------------------------------------------
| Success Route
|--------------------------------------------------------------------------
*/

Route::get('/success', function () {
    return view('website.checkout.success');
})->name('success');


/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Page
Route::get('/customer/login', [CustomerAuthController::class, 'loginForm'])
    ->name('customer.login');

// Register Page
Route::get('/customer/register', [CustomerAuthController::class, 'registerForm'])
    ->name('customer.register');

// Register Submit
Route::post('/customer/register', [CustomerAuthController::class, 'register'])
    ->name('customer.register.post');

// Login Submit
Route::post('/customer/login', [CustomerAuthController::class, 'login'])
    ->name('customer.login.post');

// Logout
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])
    ->name('customer.logout');


/*
|--------------------------------------------------------------------------
| Customer Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:customer')->group(function () {

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('check-out');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('check-out-store');


    // Customer Dashboard
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');

    // Customer Orders
    Route::get('/customer/orders', [CustomerDashboardController::class, 'orders'])
        ->name('customer.orders');

    // Customer Order Details
    Route::get('/customer/order/{id}', [CustomerDashboardController::class, 'orderDetails'])
        ->name('customer.order.details');

    // Customer Invoice
    Route::get('/customer/invoice/{id}', [CustomerDashboardController::class, 'invoice'])
        ->name('customer.invoice');

    // Customer Profile
    Route::get('/customer/profile', [CustomerDashboardController::class, 'profile'])
        ->name('customer.profile');

    // Update Customer Profile
    Route::post('/customer/profile/update', [CustomerDashboardController::class, 'profileUpdate'])
        ->name('customer.profile.update');
});


/*
|--------------------------------------------------------------------------
| Admin Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Slider
    |--------------------------------------------------------------------------
    */

    Route::resource('sliders', SliderController::class);


    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    */

    Route::get('/category', [CategoryController::class, 'index'])
        ->name('category.index');

    Route::post('/category/store', [CategoryController::class, 'store'])
        ->name('category.store');

    Route::get('/category/manage', [CategoryController::class, 'manage'])
        ->name('category.manage');

    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])
        ->name('category.edit');

    Route::put('/category/update/{id}', [CategoryController::class, 'update'])
        ->name('category.update');

    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])
        ->name('category.delete');


    /*
    |--------------------------------------------------------------------------
    | Subcategory
    |--------------------------------------------------------------------------
    */

    Route::get('/subcategory', [SubcategoryController::class, 'index'])
        ->name('subcategory.index');

    Route::post('/subcategory/store', [SubcategoryController::class, 'store'])
        ->name('subcategory.store');

    Route::get('/subcategory/manage', [SubcategoryController::class, 'manage'])
        ->name('subcategory.manage');

    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])
        ->name('subcategory.edit');

    Route::put('/subcategory/update/{id}', [SubcategoryController::class, 'update'])
        ->name('subcategory.update');

    Route::delete('/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])
        ->name('subcategory.delete');


    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    */

    Route::get('/brand', [BrandController::class, 'index'])
        ->name('brand.index');

    Route::post('/brand/store', [BrandController::class, 'store'])
        ->name('brand.store');

    Route::get('/brand/manage', [BrandController::class, 'manage'])
        ->name('brand.manage');

    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])
        ->name('brand.edit');

    Route::put('/brand/update/{id}', [BrandController::class, 'update'])
        ->name('brand.update');

    Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])
        ->name('brand.delete');


    /*
    |--------------------------------------------------------------------------
    | Unit
    |--------------------------------------------------------------------------
    */

    Route::get('/unit', [UnitController::class, 'index'])
        ->name('unit.index');

    Route::post('/unit/store', [UnitController::class, 'store'])
        ->name('unit.store');

    Route::get('/unit/manage', [UnitController::class, 'manage'])
        ->name('unit.manage');

    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])
        ->name('unit.edit');

    Route::put('/unit/update/{id}', [UnitController::class, 'update'])
        ->name('unit.update');

    Route::delete('/unit/delete/{id}', [UnitController::class, 'destroy'])
        ->name('unit.delete');


    /*
    |--------------------------------------------------------------------------
    | Product
    |--------------------------------------------------------------------------
    */

    Route::get('/product', [ProductController::class, 'index'])
        ->name('product.index');

    Route::get('/product/get-subcategories/{id}', [ProductController::class, 'getSubcategory'])
        ->name('product.get-subcategories');

    Route::post('/product/store', [ProductController::class, 'store'])
        ->name('product.store');

    Route::get('/product/manage', [ProductController::class, 'manage'])
        ->name('product.manage');

    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])
        ->name('product.edit');

    Route::put('/product/update/{id}', [ProductController::class, 'update'])
        ->name('product.update');

    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])
        ->name('product.delete');


    /*
    |--------------------------------------------------------------------------
    | Admin Orders
    |--------------------------------------------------------------------------
    */

    // Order List
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('admin.orders');

    // Order Details
    Route::get('/order/details/{id}', [OrderController::class, 'show'])
        ->name('admin.order.details');

    // Confirm Order
    Route::get('/admin/order-confirm/{id}', [OrderController::class, 'confirmOrder'])
        ->name('admin.order.confirm');

    // Cancel Order
    Route::get('/admin/order/cancel/{id}', [OrderController::class, 'cancelOrder'])
        ->name('admin.order.cancel');

    // Approve Payment
    Route::post('/admin/payment/approve/{id}', [OrderController::class, 'approvePayment'])
        ->name('admin.payment.approve');

    // Admin Invoice
    Route::get('/admin/invoice/{id}', [OrderController::class, 'invoice'])
        ->name('admin.invoice');

});