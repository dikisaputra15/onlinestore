<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokasiteknisiController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\JeniskerusakanController;
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
Route::get('/api/teknisi', [HomeController::class, 'getTeknisi']);

Route::get('/Alllogin', function () {
    return view('pages.auth.loginadmin');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('dashboard', function () {
    //     return view('pages.dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/itservice', [App\Http\Controllers\HomeController::class, 'itservice']);
    Route::get('/tracking-teknisi', [App\Http\Controllers\HomeController::class, 'tracking']);
    Route::get('/myorder', [App\Http\Controllers\HomeController::class, 'myorder']);
    Route::get('/teknisi/{id}/pesan', [App\Http\Controllers\PesananController::class, 'pesan']);
    Route::post('/proses-pesan-teknisi', [App\Http\Controllers\PesananController::class, 'prosespesan']);
    Route::get('/pesan/{id}/bayar', [App\Http\Controllers\PesananController::class, 'formbayar']);
    Route::post('/proses-pembayaran', [App\Http\Controllers\PesananController::class, 'prosesbayar']);
    Route::get('/pesananmasuk', [App\Http\Controllers\PesananController::class, 'pesananmasuk']);
    Route::get('/pesan/{id}/updatestatus', [App\Http\Controllers\PesananController::class, 'formupdatestatus']);
    Route::post('/prosesstatus', [App\Http\Controllers\PesananController::class, 'prosesstatus']);
    Route::get('/dataservice', [App\Http\Controllers\PesananController::class, 'dataservice']);
    Route::get('/pesan/{id}/invoice', [App\Http\Controllers\PesananController::class, 'invoice']);
    Route::get('/laporan', [App\Http\Controllers\PesananController::class, 'formlapor']);
    Route::post('/pdfpenjualan', [App\Http\Controllers\PesananController::class, 'lihatpdf']);
    Route::resource('user', UserController::class);
    Route::resource('lokasi', LokasiteknisiController::class);
    Route::resource('tarif', TarifController::class);
    Route::resource('jeniskerusakan', JeniskerusakanController::class);
});
