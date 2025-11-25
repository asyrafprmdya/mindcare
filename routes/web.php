<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// --- PUBLIC ROUTES ---
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// --- USER ROUTES (Protected) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/laporan', [AuthController::class, 'laporan']);
    Route::get('/chat', [AuthController::class, 'chat'])->name('chat.index');
    Route::post('/chat/send', [AuthController::class, 'sendMessage'])->name('chat.send');
    Route::get('/logout', [AuthController::class, 'logout']);
});
// === GROUP ROUTE ADMIN ===
Route::prefix('admin')->name('admin.')->group(function () {
    
    // 1. Login Admin
    Route::get('/', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    // 2. Halaman Admin (Wajib Login)
    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Manajemen Pengguna
        Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
        Route::post('/pengguna', [AdminController::class, 'storePengguna'])->name('pengguna.store');
        Route::delete('/pengguna/{id}', [AdminController::class, 'destroyPengguna'])->name('pengguna.destroy');

        // Manajemen Pasien
        Route::get('/pasien', [AdminController::class, 'pasien'])->name('pasien');
        Route::post('/pasien', [AdminController::class, 'storePasien'])->name('pasien.store');
        Route::put('/pasien/{id}', [AdminController::class, 'updatePasien'])->name('pasien.update');
        Route::delete('/pasien/{id}', [AdminController::class, 'destroyPasien'])->name('pasien.destroy');

        // Manajemen Sistem
        Route::get('/sistem', [AdminController::class, 'sistem'])->name('sistem');
        Route::post('/sistem', [AdminController::class, 'updateSistem'])->name('sistem.update');
    });
});
