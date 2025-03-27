<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ManajemenController;

// Home Route
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Master Data
Route::get('/master-data/server', [MasterDataController::class, 'server'])->name('master-data.server');
Route::get('/master-data/infrastruktur', [MasterDataController::class, 'infrastruktur'])->name('master-data.infrastruktur');

// Pengajuan
Route::get('/pengajuan/jaringan', [PengajuanController::class, 'jaringan'])->name('pengajuan.jaringan');
Route::get('/pengajuan/server', [PengajuanController::class, 'server'])->name('pengajuan.server');
Route::get('/pengajuan/aplikasi', [PengajuanController::class, 'aplikasi'])->name('pengajuan.aplikasi');

// Manajemen
Route::get('/manajemen/pengajuan', [ManajemenController::class, 'pengajuan'])->name('manajemen.pengajuan');
Route::get('/manajemen/user', [ManajemenController::class, 'user'])->name('manajemen.user');
