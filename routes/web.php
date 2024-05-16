<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('livewire.user-page');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';

// Routes that require authentication and admin check
Route::group(['middleware' => ['auth', RedirectIfNotAdmin::class]], function () {
	Route::get('/', [HomeController::class, 'home']);

	Route::get('/user-management', [AdminController::class, 'index']);
	Route::post('/user-management', [AdminController::class, 'store']);
	Route::get('/user-management/create', [AdminController::class, 'create']);
	Route::get('/user-management/{id}/edit', [AdminController::class, 'edit']);
	Route::put('/user-management/{id}', [AdminController::class, 'update']);
	Route::delete('/user-management/{id}', [AdminController::class, 'destroy']);

	Route::get('/brands-management', [BrandController::class, 'index']);
	Route::post('/brands-management', [BrandController::class, 'store']);
	Route::get('/brands-management/create', [BrandController::class, 'create']);
	Route::get('/brands-management/{id}/edit', [BrandController::class, 'edit']);
	Route::put('/brands-management/{id}', [BrandController::class, 'update']);
	Route::delete('/brands-management/{id}', [BrandController::class, 'destroy']);

	Route::get('/categories-management', [CategoryController::class, 'index']);
	Route::post('/categories-management', [CategoryController::class, 'store']);
	Route::get('/categories-management/create', [CategoryController::class, 'create']);
	Route::get('/categories-management/{id}/edit', [CategoryController::class, 'edit']);
	Route::put('/categories-management/{id}', [CategoryController::class, 'update']);
	Route::delete('/categories-management/{id}', [CategoryController::class, 'destroy']);

	Route::get('/products-management', [ProductController::class, 'index']);
	Route::post('/products-management', [ProductController::class, 'store']);
	Route::get('/products-management/create', [ProductController::class, 'create']);
	Route::get('/products-management/{id}/edit', [ProductController::class, 'edit']);
	Route::put('/products-management/{id}', [ProductController::class, 'update']);
	Route::delete('/products-management/{id}', [ProductController::class, 'destroy']);

	Route::get('/orders-management', [OrderController::class, 'index']);
	Route::post('/orders-management', [OrderController::class, 'store']);
	Route::get('/orders-management/create', [OrderController::class, 'create']);
	Route::get('/orders-management/{id}/edit', [OrderController::class, 'edit']);
	Route::get('/orders-management/{id}/view', [OrderController::class, 'view']);
	Route::put('/orders-management/{orderId}', [OrderController::class, 'update']);
	Route::delete('/orders-management/{orderId}', [OrderController::class, 'destroy']);

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
Route::post('/login', [SessionsController::class, 'store'])->name('login');

Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

Route::get('/welcome', function () {
	return view('welcome');
})->name('welcome');

// Frontend routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute yang memerlukan autentikasi dan verifikasi
	Route::get('/cart', CartPage::class)->name('cart.page');
	Route::get('/products/{slug}', ProductDetailPage::class)->name('productdetail.page');
	Route::get('/checkout', CheckoutPage::class)->name('checkout.page');
	Route::get('/my-orders', MyOrdersPage::class)->name('my-orders.page');
	Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('my-orders-detail.page');
	Route::get('/success', SuccessPage::class);
	Route::get('/cancel', CancelPage::class);
});

// Rute yang dapat diakses tanpa autentikasi
Route::get('/', UserPage::class)->name('user.page');
Route::get('/categories', CategoriesPage::class)->name('categories.page');
Route::get('/products', ProductsPage::class)->name('products.page');

