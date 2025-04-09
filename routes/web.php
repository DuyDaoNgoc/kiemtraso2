<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Models\Slide;

// Trang chủ & các chức năng mua hàng
Route::get('/', function () {
    return view('home');
});
Route::get('/trangchu', [PageController::class, 'index'])->name('trangchu');
Route::get('/cart/{id}', [PageController::class, 'addToCart'])->name('add_cart');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/order', [PageController::class, 'order'])->name('order');

// Product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/shopping-cart', [CartController::class, 'index'])->name('cart');
Route::patch('reduce-one/{id}', [CartController::class, 'reduce'])->name('cart.reduce');
Route::delete('delete-item/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('increase-item/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/del-cart/{id}', [PageController::class, 'delCartItem'])->name('banhang.xoagiohang');
Route::post('/dat-hang', [CheckoutController::class, 'postDatHang'])->name('banhang.postdathang');

// Slider
Route::get('/slider', function () {
    $slides = Slide::all();
    return view('slider', compact('slides'));
});

// Đăng ký
Route::get('/dangky', [PageController::class, 'getSignin'])->name('getsignin');
Route::post('/dangky', [PageController::class, 'postSignin'])->name('postsignin');

// Đăng nhập ✅ ĐÃ THÊM
Route::get('/dangnhap', [PageController::class, 'getLogin'])->name('getlogin');
Route::post('/dangnhap', [PageController::class, 'postLogin'])->name('postlogin');

// Đăng xuất
Route::get('/dangxuat', [PageController::class, 'getLogout'])->name('getlogout');

// Quản trị
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});