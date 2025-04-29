<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\InfrastrukturController;
use App\Http\Controllers\JaringanController;

// Home Route
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Master Data
Route::resource('/master-data/server', ServersController::class)->names('master-data.server');
Route::resource('/master-data/infrastruktur', InfrastrukturController::class)->names('master-data.infrastruktur');

// Pengajuan
Route::resource('/pengajuan/jaringan', JaringanController::class)->names('pengajuan.jaringan');
Route::resource('/pengajuan/server', PengajuanController::class)->names('pengajuan.server');
Route::get('/pengajuan/aplikasi', [PengajuanController::class, 'aplikasi'])->name('pengajuan.aplikasi');

// Manajemen
Route::get('/manajemen/pengajuan', [ManajemenController::class, 'pengajuan'])->name('manajemen.pengajuan');
Route::get('/manajemen/user', [ManajemenController::class, 'user'])->name('manajemen.user');
