<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\ImageController as Image;
use App\Http\Controllers\Admin\Management\CategoryController as Category;
use App\Http\Controllers\Admin\Management\ProductController as Product;

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
Route::resource('/categories', Category::class)->except('show');
Route::delete('/images/{image}', [Image::class, 'destroy'])->name('image.destroy');

Route::resource('/products', Product::class)->except('show');
Route::post('/products/{product}/dropzone', [Product::class, 'dropzone'])->name('products.dropzone');
