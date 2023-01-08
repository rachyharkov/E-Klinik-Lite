<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPasienController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\WorkmodeController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::prefix('workmode')->controller(WorkmodeController::class)->group(function () {
        Route::get('/', 'index')->name('workmode');
    });

    Route::prefix('pasien')->controller(PasienController::class)->group(function() {
        Route::get('/', 'index')->name('pasien.index');
        Route::post('store', 'store')->name('pasien.store');
        Route::post('update/{id}', 'update')->name('pasien.update');
        Route::delete('delete/{id}', 'destroy')->name('pasien.destroy');
    });
    Route::prefix('jenis_pasien')->controller(JenisPasienController::class)->group(function() {
        Route::get('/', 'index')->name('jenis_pasien.index');
        Route::post('store', 'store')->name('jenis_pasien.store');
        Route::post('update/{id}', 'update')->name('jenis_pasien.update');
        Route::delete('delete/{id}', 'destroy')->name('jenis_pasien.destroy');
    });
    Route::get('kategori_tindakan')->name('kategori_tindakan');
    Route::get('tindakan')->name('tindakan');
    Route::get('produsen')->name('produsen');
    Route::get('kategori_obat')->name('kategori_obat');
    Route::get('obat')->name('obat');
    Route::get('satuan_obat')->name('satuan_obat');
    Route::get('jenis_penggunaan_obat')->name('jenis_penggunaan_obat');
    Route::get('laporan')->name('laporan');


});
