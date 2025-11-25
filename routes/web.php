<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/laporan', [AuthController::class, 'laporan']);
    Route::get('/chat', [AuthController::class, 'chat'])->name('chat.index');
    Route::post('/chat/send', [AuthController::class, 'sendMessage'])->name('chat.send');
});


Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::middleware(['auth'])->group(function () {
        

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        

        Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
        Route::post('/pengguna', [AdminController::class, 'storePengguna'])->name('pengguna.store');
        Route::delete('/pengguna/{id}', [AdminController::class, 'destroyPengguna'])->name('pengguna.destroy');

     
        Route::get('/pasien', [AdminController::class, 'pasien'])->name('pasien');
        Route::post('/pasien', [AdminController::class, 'storePasien'])->name('pasien.store');
        Route::put('/pasien/{id}', [AdminController::class, 'updatePasien'])->name('pasien.update');
        Route::delete('/pasien/{id}', [AdminController::class, 'destroyPasien'])->name('pasien.destroy');

        Route::get('/sistem', [AdminController::class, 'sistem'])->name('sistem');
        Route::post('/sistem', [AdminController::class, 'updateSistem'])->name('sistem.update');
    });
});