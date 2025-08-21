<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\Management\CategoryController as Category;

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
Route::resource('/categories', Category::class)->except('show');
