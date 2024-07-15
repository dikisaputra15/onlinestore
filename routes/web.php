<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/kategori/{id}/pilihkategori', [App\Http\Controllers\KategoriController::class, 'pilihkategori']);
Route::post('/cariproduk', [App\Http\Controllers\ProdukController::class, 'cariproduk']);
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact']);

Route::get('/Alllogin', function () {
    return view('pages.auth.loginadmin');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('dashboard', function () {
    //     return view('pages.dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/admintransaksi', [App\Http\Controllers\HomeController::class, 'admintransaksi']);
    Route::get('/lappenjualan', [App\Http\Controllers\HomeController::class, 'formlappenjualan']);
    Route::post('/pdfpenjualan', [App\Http\Controllers\HomeController::class, 'lihatpdf']);

    Route::resource('user', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);

    Route::post('/keranjang', [App\Http\Controllers\KeranjangController::class, 'storekeranjang']);
    Route::post('/keranjangnew', [App\Http\Controllers\KeranjangController::class, 'storekeranjangnew']);
    Route::get('/allkeranjang', [App\Http\Controllers\KeranjangController::class, 'index']);
    Route::get('/keranjang/delker/{id}', [App\Http\Controllers\KeranjangController::class, 'destroykeranjang']);
    Route::get('/pesanan', [App\Http\Controllers\PesananController::class, 'index']);
    Route::get('/checkout', [App\Http\Controllers\PesananController::class, 'checkout']);
    Route::post('/prosespesanan', [App\Http\Controllers\PesananController::class, 'storepesanan']);
    Route::get('/invoice/{id}/lihatinvoice', [App\Http\Controllers\PesananController::class, 'lihatinvoice']);
    Route::get('/pembayaran/{id}/bayar', [App\Http\Controllers\PesananController::class, 'bayar']);
    Route::get('/po/{id}/formpo', [App\Http\Controllers\PesananController::class, 'formpo']);
    Route::post('/prosespo', [App\Http\Controllers\PesananController::class, 'storepo']);
});
