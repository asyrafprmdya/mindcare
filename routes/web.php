<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// === 1. PUBLIC ROUTES (Tamu) ===
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// === 2. USER ROUTES (Dokter/Konselor/Pasien) ===
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Profil Pasien
    Route::get('/pasien', [AuthController::class, 'pasien'])->name('pasien.index');
    
    // Chat AI
    Route::get('/chat', [AuthController::class, 'chat'])->name('chat.index');
    Route::post('/chat/send', [AuthController::class, 'sendMessage'])->name('chat.send');
    
    // Fitur Lain
    Route::get('/laporan', [AuthController::class, 'laporan'])->name('laporan'); // Diberi nama agar aman
    
    // PERBAIKAN DI SINI: Menambahkan ->name('logout')
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// === 3. ADMIN ROUTES (Khusus Administrator) ===
Route::prefix('admin')->name('admin.')->group(function () {
    // Login Admin
    Route::get('/', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    // Halaman Admin (Protected)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Manajemen Pengguna
        Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
        Route::post('/pengguna', [AdminController::class, 'storePengguna'])->name('pengguna.store');
        Route::delete('/pengguna/{id}', [AdminController::class, 'destroyPengguna'])->name('pengguna.destroy');

        // Manajemen Pasien (CRUD Admin)
        Route::get('/pasien', [AdminController::class, 'pasien'])->name('pasien');
        Route::post('/pasien', [AdminController::class, 'storePasien'])->name('pasien.store');
        Route::put('/pasien/{id}', [AdminController::class, 'updatePasien'])->name('pasien.update');
        Route::delete('/pasien/{id}', [AdminController::class, 'destroyPasien'])->name('pasien.destroy');

        // Manajemen Sistem
        Route::get('/sistem', [AdminController::class, 'sistem'])->name('sistem');
        Route::post('/sistem', [AdminController::class, 'updateSistem'])->name('sistem.update');
    });
});