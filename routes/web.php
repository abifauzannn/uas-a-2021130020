<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\AppController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

Route::get('/', [AppController::class, 'index'])->name('index');
Route::resource('menus', MenuController::class);
Route::get('/order', [OrderController::class, 'order'])->name ('order');
Route::post('/order', [OrderController::class, 'createOrder'])->name('order.createOrder');
Route::get('/list', [OrderController::class, 'orderList'])->name('orders.list');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show'); // New route for order details
