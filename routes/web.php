<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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
        Route::get('create', 'create')->name('pasien.create');
        Route::post('store', 'store')->name('pasien.store');
        Route::get('edit/{id}', 'edit')->name('pasien.edit');
        Route::post('update/{id}', 'update')->name('pasien.update');
        Route::delete('delete/{id}', 'destroy')->name('pasien.destroy');
        Route::get('search', 'search')->name('pasien.search');
    });
    Route::get('jenis_pasien')->name('jenis_pasien');
    Route::get('kategori_tindakan')->name('kategori_tindakan');
    Route::get('tindakan')->name('tindakan');
    Route::get('produsen')->name('produsen');
    Route::get('kategori_obat')->name('kategori_obat');
    Route::get('obat')->name('obat');
    Route::get('satuan_obat')->name('satuan_obat');
    Route::get('jenis_penggunaan_obat')->name('jenis_penggunaan_obat');


});
