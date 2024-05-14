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
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use App\Livewire\UserPage;
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

Route::group(['middleware' => ['auth', RedirectIfNotAdmin::class]], function () {
	// Rute yang memerlukan autentikasi
	Route::get('/', [HomeController::class, 'home']);

	Route::get('/user-management', [AdminController::class, 'index']);
	Route::post('/user-management', [AdminController::class, 'store']);
	Route::get('/user-management/create', [AdminController::class, 'create']);
	Route::get('/user-management/{id}/edit', [AdminController::class, 'edit']);
	Route::put('/user-management/{id}', [AdminController::class, 'update']);
	Route::delete('/user-management/{id}', [AdminController::class, 'destroy']);

	Route::get('/brands', [BrandController::class, 'index']);
	Route::post('/brands', [BrandController::class, 'store']);
	Route::get('/brands/create', [BrandController::class, 'create']);
	Route::get('/brands/{id}/edit', [BrandController::class, 'edit']);
	Route::put('/brands/{id}', [BrandController::class, 'update']);
	Route::delete('/brands/{id}', [BrandController::class, 'destroy']);

	Route::get('/categories', [CategoryController::class, 'index']);
	Route::post('/categories', [CategoryController::class, 'store']);
	Route::get('/categories/create', [CategoryController::class, 'create']);
	Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
	Route::put('/categories/{id}', [CategoryController::class, 'update']);
	Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

	Route::get('/products', [ProductController::class, 'index']);
	Route::post('/products', [ProductController::class, 'store']);
	Route::get('/products/create', [ProductController::class, 'create']);
	Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
	Route::put('/products/{id}', [ProductController::class, 'update']);
	Route::delete('/products/{id}', [ProductController::class, 'destroy']);

	Route::get('/orders', [OrderController::class, 'index']);
	Route::post('/orders', [OrderController::class, 'store']);
	Route::get('/orders/create', [OrderController::class, 'create']);
	Route::get('/orders/{id}/edit', [OrderController::class, 'edit']);
	Route::get('/orders/{id}/view', [OrderController::class, 'view']);
	Route::put('/orders/{orderId}', [OrderController::class, 'update']);
	Route::delete('/orders/{orderId}', [OrderController::class, 'destroy']);

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);

	Route::get('/dashboard', function () {
		// Periksa apakah pengguna adalah admin
		if (Auth::check() && Auth::user()->role === 'admin') {
			return view('dashboard');
		} else {
			return redirect()->route('user.page'); // Mengarahkan pengguna ke halaman user jika bukan admin
		}
	})->name('dashboard');
});

Route::group(['middleware' => 'guest'], function () {
	// Rute untuk pengguna yang belum login
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');


Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

Route::get('/welcome', function () {
	return view('welcome');
})->name('welcome');;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/user-page', UserPage::class)->name('user.page');
Route::get('/categories', CategoriesPage::class)->name('categories.page');
Route::get('/products', ProductsPage::class)->name('products.page');
Route::get('/cart', CartPage::class)->name('cart.page');
Route::get('/products/{product}', ProductDetailPage::class)->name('productdetail.page');

Route::get('/checkout', CheckoutPage::class)->name('checkout.page');
Route::get('/my-orders', MyOrdersPage::class)->name('my-orders.page');
Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('my-orders-detail.page');

Route::get('/login-user', LoginPage::class);
Route::get('/register-user', RegisterPage::class);
Route::get('/forgot-user', ForgotPasswordPage::class);
Route::get('/reset-user', ResetPasswordPage::class);

Route::get('/success', SuccessPage::class);
Route::get('/cancel', CancelPage::class);
