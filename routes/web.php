<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPasienController;
use App\Http\Controllers\KategoriTindakanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProdusenController;
use App\Http\Controllers\RekamMedis;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\WorkmodeController;
use App\Models\KategoriTindakan;

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

        Route::prefix('jenis_pasien')->controller(JenisPasienController::class)->group(function() {
            Route::get('/', 'index')->name('jenis_pasien.index');
        });
    });

    Route::prefix('tindakan')->controller(TindakanController::class)->group(function() {
        Route::get('/', 'index')->name('tindakan.index');
        Route::post('store', 'store')->name('tindakan.store');
        Route::post('update/{id}', 'update')->name('tindakan.update');
        Route::delete('delete/{id}', 'destroy')->name('tindakan.destroy');

        Route::prefix('kategori')->controller(KategoriTindakanController::class)->group(function() {
            Route::get('/', 'index')->name('kategori_tindakan.index');
        });
    });

    Route::prefix('rekam_medis')->controller(RekamMedis::class)->group(function() {
        Route::get('/{id}', 'index')->name('rekam_medis.index');
    });

    Route::prefix('obat')->group(function() {
        Route::get('/')->name('obat');
        Route::get('kategori_obat')->name('kategori_obat');
        Route::get('satuan_obat')->name('satuan_obat');
        Route::get('jenis_penggunaan_obat')->name('jenis_penggunaan_obat');
        Route::get('laporan')->name('laporan');


        Route::prefix('produsen')->controller(ProdusenController::class)->group(function() {
            Route::get('/', 'index')->name('produsen.index');
            Route::post('store', 'store')->name('produsen.store');
            Route::post('update/{id}', 'update')->name('produsen.update');
            Route::delete('delete/{id}', 'destroy')->name('produsen.destroy');
        });
    });




});
