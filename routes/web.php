<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionsController;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Livewire\ChangePasswordPage;
use App\Livewire\EditProfilePage;
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
	return view('user.page');
});

Route::get('/home', function () {
	return view('livewire.user-page');
})->middleware(['auth', 'verified'])->name('dashboard');


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
	
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Frontend routes
// Rute yang dapat diakses tanpa login
Route::get('/', UserPage::class)->name('user.page');
Route::get('/categories', CategoriesPage::class)->name('categories.page');
Route::get('/products', ProductsPage::class)->name('products.page');

Route::get('/products/{slug}', ProductDetailPage::class)->name('productdetail.page');
// Rute yang memerlukan autentikasi dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/home', UserPage::class)->name('user.page');
	Route::get('/profile', EditProfilePage::class)->name('edit-profile');
	Route::get('/change-password', ChangePasswordPage::class)->name('change-password');
	Route::get('/checkout', CheckoutPage::class)->name('checkout.page');
	Route::get('/cart', CartPage::class)->name('cart.page');
	Route::get('/my-orders', MyOrdersPage::class)->name('my-orders.page');
	Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders-detail.page');
	Route::get('/my-orders/{order_id}/invoice', [InvoiceController::class, 'show']);
	Route::get('/my-orders/{order_id}/generate', [InvoiceController::class, 'generate']);
	Route::get('/success', SuccessPage::class)->name('success');
	Route::get('/cancel', CancelPage::class);
});


// Route::middleware('auth')->group(function () {
// 	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// 	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// 	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::post('/login', [SessionsController::class, 'store'])->name('login');

// Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// Route::get('/login', function () {
	// 	return view('session/login-session');
	// })->name('login');