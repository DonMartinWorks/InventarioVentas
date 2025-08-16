<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('home');
