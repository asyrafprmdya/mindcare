<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;

// Public Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (Protected by auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/chat', [AuthController::class, 'chat'])->name('chat.index');
    Route::post('/chat/send', [AuthController::class, 'sendMessage'])->name('chat.send');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    
    // --- TAMBAHKAN ROUTE INI ---
    Route::get('/pasien', [AuthController::class, 'pasien'])->name('pasien.index');
    
    Route::get('/chat', [AuthController::class, 'chat'])->name('chat.index');
    Route::post('/chat/send', [AuthController::class, 'sendMessage'])->name('chat.send');
    Route::get('/laporan', [AuthController::class, 'laporan']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Public Routes
    Route::get('/', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    
    // Admin Protected Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Manajemen Pasien Routes
        Route::get('/pasien', [AdminController::class, 'pasien'])->name('pasien');
        Route::post('/pasien', [AdminController::class, 'storePasien'])->name('pasien.store');
        Route::put('/pasien/{id}', [AdminController::class, 'updatePasien'])->name('pasien.update');
        Route::delete('/pasien/{id}', [AdminController::class, 'destroyPasien'])->name('pasien.destroy');
        
        // Manajemen Pengguna Routes
        Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
        Route::post('/pengguna', [AdminController::class, 'storePengguna'])->name('pengguna.store');
        Route::delete('/pengguna/{id}', [AdminController::class, 'destroyPengguna'])->name('pengguna.destroy');
        
        // Manajemen Sistem Routes
        Route::get('/sistem', [AdminController::class, 'sistem'])->name('sistem');
        Route::post('/sistem', [AdminController::class, 'updateSistem'])->name('sistem.update');
        
        // Laporan Admin
        Route::get('/laporan', [LaporanController::class, 'adminIndex'])->name('laporan');
    });
});