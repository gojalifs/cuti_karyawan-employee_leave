<?php

use App\Http\Controllers\mail\TestMailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PermohonanCutiController;
use App\Http\Controllers\RiwayatPermohonanController;


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
 
Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
 
Route::group(['middleware' => 'auth'], function () {
    
    // Admin
    Route::get('admin/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/permohonan',[PermohonanCutiController::class, 'index'])->name('permohonan.index');
    Route::get('admin/permohonan/disetujui',[RiwayatPermohonanController::class, 'disetujui'])->name('permohonan.disetujui');
    Route::get('admin/permohonan/ditolak',[RiwayatPermohonanController::class, 'ditolak'])->name('permohonan.ditolak');
    Route::get('admin/permohonan/setuju/{id}',[PermohonanCutiController::class, 'setuju'])->name('permohonan.setuju');
    Route::get('admin/permohonan/tolak/{id}',[PermohonanCutiController::class, 'tolak'])->name('permohonan.tolak');
    Route::get('admin/karyawan',[KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('admin/karyawan/{id}',[KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('admin/karyawan/',[KaryawanController::class, 'update'])->name('karyawan.update');
    Route::post('admin/karyawan/add', [KaryawanController::class,'store'])->name('karyawan.add');
    
    
    // Karyawan
    Route::get('karyawan/dashboard',[DashboardController::class, 'show'])->name('karyawan.dashboard');
    Route::get('karyawan/permohonan/disetujui',[RiwayatPermohonanController::class, 'disetujui'])->name('karyawan.permohonan.disetujui');
    Route::get('karyawan/permohonan/ditolak',[RiwayatPermohonanController::class, 'ditolak'])->name('karyawan.permohonan.ditolak');
    Route::post('karyawan',[PermohonanCutiController::class, 'store'])->name('permohonan.insert');

    Route::get('karyawan/permohonan',[PermohonanCutiController::class, 'show'])->name('karyawan.permohonan');

    // Email
    Route::get('send-approve', [TestMailController::class, 'send'])->name('send.approve');
});
