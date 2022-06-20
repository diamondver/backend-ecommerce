<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Alamat;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Gambar;
use App\Http\Controllers\Keranjang;
use App\Http\Controllers\Produk;
use App\Http\Controllers\Produk_Keranjang;
use App\Http\Controllers\Transaksi;
use App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('user', User::class)->middleware(['auth:sanctum', 'auth.admin'])->except('store');
Route::post('register', [User::class, 'store']);

Route::apiResource('keranjang', Keranjang::class)->middleware('auth:sanctum');

Route::controller(Auth::class)->group(function() {
    Route::post('auth', 'login');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
    Route::post('admin/auth', 'loginAdmin');
});

Route::apiResource('gambar', Gambar::class)->middleware(['auth:sanctum', 'auth.admin']);

Route::apiResource('alamat', Alamat::class)->middleware('auth:sanctum');

Route::apiResource('transaksi', Transaksi::class)->middleware('auth:sanctum')->except('update', 'destroy');

Route::apiResource('produk', Produk::class)->except('index', 'show')->middleware(['auth:sanctum', 'auth.admin']);
Route::apiResource('produk', Produk::class)->only('index', 'show');
