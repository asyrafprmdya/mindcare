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

     
        Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

        Route::get('/sistem', [AdminController::class, 'sistem'])->name('sistem');
        Route::post('/sistem', [AdminController::class, 'updateSistem'])->name('sistem.update');
    });
});