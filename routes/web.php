<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\jenis_rekening\AbkJenisRekening;
use App\Http\Controllers\jenis_rekening\AbkJenisRekeningController;
use App\Http\Controllers\kas\AbkKasController;
use App\Http\Controllers\perusahaan\AbkPerusahaanController;
use App\Http\Controllers\projek\AbkProjekController;
use App\Http\Controllers\rekening\AbkRekeningController;
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


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/action-register', [AuthController::class,'action_register'])->name('action.register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// FORGOT PASSWORD
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// AJAX
Route::get('get-rekening/{jenis_rekening_id}', [AbkKasController::class, 'getRekening'])->name('get.rekening');
Route::get('get-rekening-update/{id}', [AbkKasController::class, 'getRekeningUpdate'])->name('get.rekening.update');


Route::middleware(['auth'])->group(function () {
    
    // Route prefix untuk Produsen

    Route::prefix('owner')->name('owner.')->middleware('CekUserLogin:1')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'abk'])->name('dashboard');
    });
    

    Route::prefix('abb')->name('abk.')->middleware('CekUserLogin:2')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'abk'])->name('dashboard');
        
        // PERUSAHAAN
        Route::get('perusahaan', [AbkPerusahaanController::class, 'index'])->name('perusahaan');
        Route::post('store/perusahaan', [AbkPerusahaanController::class, 'store'])->name('store.perusahaan');
        Route::put('update/perusahaan/{id}', [AbkPerusahaanController::class, 'update'])->name('update.perusahaan');
        Route::delete('delete/perusahaan/{id}', [AbkPerusahaanController::class, 'delete'])->name('delete.perusahaan');
        
        // PROJEK
        Route::get('projek', [AbkProjekController::class, 'index'])->name('projek');
        Route::post('store/projek', [AbkProjekController::class, 'store'])->name('store.projek');
        Route::put('update/projek/{id}', [AbkProjekController::class, 'update'])->name('update.projek');
        Route::delete('delete/projek/{id}', [AbkProjekController::class, 'delete'])->name('delete.projek');
        Route::get('detail/projek/{id}', [AbkProjekController::class, 'detail'])->name('detail.projek');
        Route::get('/projek/filter', [AbkProjekController::class, 'filter'])->name('projek.filter');
        Route::get('/projek/export-excel', [AbkProjekController::class, 'exportExcel'])->name('projek.export.excel');
        
        // JENIS REKENING
        Route::get('jenis-rekening', [AbkJenisRekeningController::class, 'index'])->name('jenis.rekening');
        Route::post('tambah/jenis-rekening', [AbkJenisRekeningController::class, 'store'])->name('store.jenis.rekening');
        Route::put('update/jenis-rekening/{id}', [AbkJenisRekeningController::class, 'update'])->name('update.jenis.rekening');
        Route::delete('delete/jenis-rekening/{id}', [AbkJenisRekeningController::class, 'delete'])->name('delete.jenis.rekening');

        // REKENING
        Route::get('rekening', [AbkRekeningController::class, 'index'])->name('rekening');
        Route::post('store/rekening', [AbkRekeningController::class, 'store'])->name('store.rekening');
        Route::put('update/rekening/{id}', [AbkRekeningController::class, 'update'])->name('update.rekening');
        Route::delete('delete/rekening/{id}', [AbkRekeningController::class, 'delete'])->name('delete.rekening');
        
        // TRANSAKSI
        Route::get('kas-besar', [AbkKasController::class, 'index'])->name('kas');
        Route::post('store/kas-besar', [AbkKasController::class, 'store'])->name('store.kas');
        Route::put('update/kas-besar/{id}', [AbkKasController::class, 'update'])->name('update.kas');
        Route::delete('delete/kas-besar/{id}', [AbkKasController::class, 'delete'])->name('delete.kas');
    });

    Route::prefix('ap')->name('ap.')->middleware('CekUserLogin:2')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'abk'])->name('dashboard');
    });

});