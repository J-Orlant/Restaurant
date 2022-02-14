<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesananWaiterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardWaiterController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi;

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

// Auth
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('loginPost');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('registerPost');


// Admin Panel
Route::middleware(['auth','isAdmin'])->group(function() {
    Route::get('/admin-panel', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/admin-panel/menu', MenuController::class);
    Route::resource('/admin-panel/pesanan', PesananController::class);
    Route::resource('/admin-panel/transaksi', TransaksiController::class);
    // Route::get('/admin-panel/transaksi/detail', [TransaksiController::class, 'detail'])->name('transaksi.detail');
    Route::resource('/admin-panel/user', UserController::class);
});

// Waiter Panel
Route::middleware(['auth', 'isWaiter'])->group(function() {
    Route::get('/waiter-panel', [DashboardWaiterController::class, 'index'])->name('dashboardWaiter');
    Route::get('/waiter-panel/pesanan/{nama}-{meja}', [DashboardWaiterController::class, 'detail'])->name('pesanan-detail');
    Route::patch('/waiter-panel/pesanan-up/{nama}', [DashboardWaiterController::class, 'pesananConfirm'])->name('pesanan-confirm');

    // Order
    Route::get('/waiter-panel/order', [DashboardWaiterController::class, 'order'])->name('waiter-order');
    Route::post('/waiter-panel/order', [DashboardWaiterController::class, 'orderAction'])->name('waiter-order-action');
    Route::get('/waiter-panel/order/menu/{nama}', [DashboardWaiterController::class, 'menu'])->name('waiter-order-menu');
    Route::post('/waiter-panel/order/menu/{nama}', [DashboardWaiterController::class, 'menuAction'])->name('waiter-order-menu-action');
    Route::post('/waiter-panel/order/menu/{nama}/cart', [DashboardWaiterController::class, 'cartInsert'])->name('cart.insert');
    Route::post('/waiter-panel/order/menu/cart/{id}', [DashboardWaiterController::class, 'cartDelete'])->name('cart.delete');
    Route::get('/waiter-panel/order/menu/cart/batal', [DashboardWaiterController::class, 'cartBatal'])->name('cart.batal');
});

