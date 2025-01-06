<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PaymentInformationController;
use App\Http\Controllers\PriceShippingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Models\PriceShipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::post('/shop/filter', [HomeController::class, 'filter'])->name('shop.filter');
Route::get('/shop/detail/{id}', [HomeController::class, 'detail'])->name('shop.detail');
Route::post('/add-to-cart/{id}', [HomeController::class, 'addtocart'])->name('add-to-cart');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/removeCart/{id}', [HomeController::class, 'removeCart'])->name('removeCart');
Route::get('/history-order', [HomeController::class, 'history'])->name('history-order');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/proses-checkout', [HomeController::class, 'prosesCheckout'])->name('proses-checkout');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


	Route::get('/category', [CategoryController::class, 'index'])->name('category');
	Route::post('/tambah-category', [CategoryController::class, 'store'])->name('tambah-category');
	Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
	Route::get('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');

	Route::get('/product', [ProductController::class, 'index'])->name('product');
	Route::post('/tambah-product', [ProductController::class, 'store'])->name('tambah-product');
	Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update-product');
	Route::get('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');

	Route::get('/price-shipping', [PriceShippingController::class, 'index'])->name('price-shipping');
	Route::post('/tambah-price-shipping', [PriceShippingController::class, 'store'])->name('tambah-price-shipping');
	Route::post('/update-price-shipping/{id}', [PriceShippingController::class, 'update'])->name('update-price-shipping');
	Route::get('/delete-price-shipping/{id}', [PriceShippingController::class, 'destroy'])->name('delete-price-shipping');
	
	Route::get('/payment-information', [PaymentInformationController::class, 'index'])->name('payment-information');
	Route::post('/tambah-payment-information', [PaymentInformationController::class, 'store'])->name('tambah-payment-information');
	Route::post('/update-payment-information/{id}', [PaymentInformationController::class, 'update'])->name('update-payment-information');
	Route::get('/delete-payment-information/{id}', [PaymentInformationController::class, 'destroy'])->name('delete-payment-information');

	Route::get('/incoming-order', [ProductController::class, 'incomingOrder'])->name('incoming-order');
	Route::get('/update-status/{id}/{status}', [ProductController::class, 'updateStatus'])->name('update-status');
	Route::get('/process-order', [ProductController::class, 'inProcess'])->name('process-order');
	Route::get('/order-sent', [ProductController::class, 'orderSent'])->name('order-sent');
	Route::get('/order-completed', [ProductController::class, 'orderCompleted'])->name('order-completed');
	Route::get('/order-rejected', [ProductController::class, 'orderRejected'])->name('order-rejected');


    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-management', [InfoUserController::class, 'userManagement'])->name('user-management');
	Route::post('/tambah-user', [InfoUserController::class, 'tambahUser'])->name('tambah-user');
	Route::post('/update-user/{id}', [InfoUserController::class, 'updateUser'])->name('update-user');
	Route::get('/delete-user/{id}', [InfoUserController::class, 'deleteUser'])->name('delete-user');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login-post', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');