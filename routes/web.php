<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\WarrantyController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CustomerAuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'renderHome'])->name('index');
Route::get('/chi-tiet/{id}', [HomeController::class, 'productDetail'])->name('details.products');
Route::get('/san-pham', [HomeController::class, 'productAll'])->name('details.all');
Route::get('/danh-muc/{categoryId}', [HomeController::class, 'showProductsByCategory'])->name('product.by.category');
Route::get('/danh-muc', [HomeController::class, 'showProductCategory'])->name('product.category');
Route::get('/thuong-hieu/{brandId}', [HomeController::class, 'showProductsByBrand'])->name('product.by.brand');
Route::get('/thuong-hieu', [HomeController::class, 'showProductBrand'])->name('product.brand');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('/gio-hang', [HomeController::class, 'cart'])->name('cart');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/brands', BrandController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/warranties', WarrantyController::class);
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/ca-nhan', [ClientProfileController::class, 'edit'])->name('customer.profile.edit');
Route::patch('/ca-nhan', [ClientProfileController::class, 'update'])->name('customer.profile.update');
Route::delete('/ca-nhan', [ClientProfileController::class, 'destroy'])->name('customer.profile.destroy');
Route::put('/ca-nhan', [ClientProfileController::class, 'password'])->name('customer.password.update');
Route::get('/dang-nhap', [CustomerAuthController::class, 'showLoginCustomer'])->name('customer.get.login');
Route::post('/dang-nhap', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::get('/dang-ky', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.get.register');
Route::post('/dang-ky', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/dang-xuat', [CustomerAuthController::class, 'logout'])->name('customer.logout');

require __DIR__ . '/auth.php';
