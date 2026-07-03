<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AnggotaAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BukuAdminController;
use App\Http\Controllers\Admin\KategoriBukuController;
use App\Http\Controllers\Admin\AnggotaAdminController;
use App\Http\Controllers\Admin\PeminjamanAdminController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\LaporanController;

// ===== LANDING =====
Route::get('/', function () {
    return view('welcome');
});

// ===== AUTH ANGGOTA =====
Route::get('/register', [AnggotaAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AnggotaAuthController::class, 'register']);
Route::get('/login', [AnggotaAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AnggotaAuthController::class, 'login']);
Route::post('/logout', [AnggotaAuthController::class, 'logout'])->name('logout');

// ===== AUTH ADMIN =====
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ===== ANGGOTA (login anggota diperlukan) =====
Route::middleware('auth:anggota')->group(function () {
    Route::get('/dashboard', function () {
        return view('anggota.dashboard');
    })->name('dashboard');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');

    Route::post('/peminjaman/{buku_id}', [PeminjamanController::class, 'ajukan'])->name('peminjaman.ajukan');
    Route::get('/peminjaman/status', [PeminjamanController::class, 'status'])->name('peminjaman.status');
    Route::get('/peminjaman/riwayat', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');

    Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{buku_id}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
});

// ===== ADMIN (login admin diperlukan) =====
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('buku', BukuAdminController::class);
    Route::resource('kategori', KategoriBukuController::class)->except(['show']);

    Route::get('/anggota', [AnggotaAdminController::class, 'index'])->name('anggota.index');
    Route::post('/anggota/{id}/verifikasi', [AnggotaAdminController::class, 'verifikasi'])->name('anggota.verifikasi');
    Route::post('/anggota/{id}/tolak', [AnggotaAdminController::class, 'tolak'])->name('anggota.tolak');

    Route::get('/peminjaman', [PeminjamanAdminController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/setujui', [PeminjamanAdminController::class, 'setujui'])->name('peminjaman.setujui');
    Route::post('/peminjaman/{id}/tolak', [PeminjamanAdminController::class, 'tolak'])->name('peminjaman.tolak');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian/{peminjaman_id}', [PengembalianController::class, 'store'])->name('pengembalian.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
