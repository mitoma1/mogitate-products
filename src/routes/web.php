<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Ensure the ProductController exists in the specified namespace
// If it doesn't exist, create it using the artisan command:
// php artisan make:controller ProductController

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


Route::get('/products/register', [ProductController::class, 'create'])->name('products.create'); // 商品登録
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // 商品一覧

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // 商品登録処理
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search'); // 商品検索
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
