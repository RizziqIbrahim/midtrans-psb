<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

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

Route::get('/home', [OrderController::class, 'index'])->name('home');
Route::get('/donasi', [OrderController::class, 'create'])->name('donasi');
Route::post('/add-data', [OrderController::class, 'store'])->name('add-data');
Route::get('/payments/{id}', [OrderController::class, 'bayar']);

Route::get('payments/notification', [PaymentController::class, 'notification']);
Route::get('payments/compoleted', [PaymentController::class, 'completed']);
Route::get('payments/failed', [PaymentController::class, 'failed']);
Route::get('payments/unfinish', [PaymentController::class, 'unfinish']);
