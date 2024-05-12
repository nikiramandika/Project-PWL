<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('/user-management', [AdminController::class, 'index']);
	Route::post('/user-management', [AdminController::class, 'store']);
	Route::get('/user-management/create', [AdminController::class, 'create']);
	Route::get('/user-management/{id}/edit', [AdminController::class, 'edit']);
	Route::put('/user-management/{id}', [AdminController::class, 'update']);


	Route::get('/brands', [BrandController::class, 'index']);
	Route::post('/brands', [BrandController::class, 'store']);
	Route::get('/brands/create', [BrandController::class, 'create']);
	Route::get('/brands/{id}/edit', [BrandController::class, 'edit']);
	Route::put('/brands/{id}', [BrandController::class, 'update']);

	Route::get('/categories', [CategoryController::class, 'index']);
	Route::post('/categories', [CategoryController::class, 'store']);
	Route::get('/categories/create', [CategoryController::class, 'create']);
	Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
	Route::put('/categories/{id}', [CategoryController::class, 'update']);


	Route::get('/products', [ProductController::class, 'index']);
	Route::post('/products', [ProductController::class, 'store']);
	Route::get('/products/create', [ProductController::class, 'create']);
	Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
	Route::put('/products/{id}', [ProductController::class, 'update']);


	Route::get('/orders', [OrderController::class, 'index']);
	Route::post('/orders', [OrderController::class, 'store']);
	Route::get('/orders/create', [OrderController::class, 'create']);
	Route::get('/orders/{id}/edit', [ProductController::class, 'edit']);
	Route::put('/orders/{id}', [ProductController::class, 'update']);





	Route::get('/logout', [SessionsController::class, 'destroy']);
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
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');