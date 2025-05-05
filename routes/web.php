<?php

use App\Http\Controllers\AplikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\InfrastrukturController;
use App\Http\Controllers\JaringanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Route untuk Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Master Data
    Route::resource('/master-data/server', ServersController::class)->names('master-data.server');
    Route::resource('/master-data/infrastruktur', InfrastrukturController::class)->names('master-data.infrastruktur');

    // Manajemen Pengajuan
    Route::resource('/manajemen/pengajuan', ManajemenController::class)->names('manajemen.pengajuan');
    Route::post('/manajemen/updateStatus', [ManajemenController::class, 'updateStatus'])->name('manajemen.updateStatus');
    // Manajemen User
    Route::resource('/manajemen/user', UserController::class)->names([
        'index' => 'manajemen.user.index',
        'create' => 'manajemen.user.create',
        'store' => 'manajemen.user.store',
        'show' => 'manajemen.user.show',
        'edit' => 'manajemen.user.edit',
        'update' => 'manajemen.user.update',
        'destroy' => 'manajemen.user.destroy'
    ]);
});

Route::middleware(['auth'])->group(function () {
    // Pengajuan Jaringan
    Route::resource('/pengajuan/jaringan', JaringanController::class)->names('pengajuan.jaringan');
    // Pengajuan Server
    Route::resource('/pengajuan/server', PengajuanController::class)->names('pengajuan.server');
    // Pengajuan Aplikasi
    Route::resource('/pengajuan/aplikasi', AplikasiController::class)->names('pengajuan.aplikasi');
});
