<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\ImageController as Image;
use App\Http\Controllers\Admin\Management\CategoryController as Category;
use App\Http\Controllers\Admin\Management\CustomerController as Customer;
use App\Http\Controllers\Admin\Management\SupplierController as Supplier;
use App\Http\Controllers\Admin\Management\ProductController as Product;
use App\Http\Controllers\Admin\Management\PurchaseController as Purchase;
use App\Http\Controllers\Admin\Management\PurchaseOrderController as PurchaseOrder;
use App\Http\Controllers\Admin\Management\QuoteController as Quote;
use App\Http\Controllers\Admin\Management\SaleController as Sale;
use App\Http\Controllers\Admin\Management\WarehouseController as Warehouse;

/*
|--------------------------------------------------------------------------
| Web Routes (Admin)
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web & auth" middleware group (prefix('/admin') name('admin.')).
|
| Make something great!
|
*/

Route::get('/', [Dashboard::class, 'index'])->name('home');

/**
 * ===========================
 *  MANAGEMENT SECTION ROUTES
 * ===========================
 */

// Inventory Section
Route::resource('/categories', Category::class)->except('show');
Route::resource('/products', Product::class)->except('show');
Route::post('/products/{product}/dropzone', [Product::class, 'dropzone'])->name('products.dropzone');
Route::resource('/warehouses', Warehouse::class)->except('show');

// Purchase Section
Route::resource('/customers', Customer::class)->except('show');

// Sale Section
Route::resource('/suppliers', Supplier::class)->except('show');

// Purchase Section
Route::resource('/purchase-orders', PurchaseOrder::class)->only(['index', 'create']);
Route::resource('/purchases', Purchase::class)->only(['index', 'create']);


// Quote Section
Route::resource('/quotes', Quote::class)->only(['index', 'create']);

// Sale Section
Route::resource('/sales', Sale::class)->only(['index', 'create']);

/**
 * Others
 */
Route::delete('/images/{image}', [Image::class, 'destroy'])->name('image.destroy');
