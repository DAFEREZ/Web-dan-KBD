<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'show'])
        ->middleware('role:ketua,sekretaris,bendahara,anggota')->name('profil');

    // ===== ADMIN =====
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

        Route::get('/audit', [AuditController::class, 'index'])->name('audit');
    });

    // ===== DATA ANGGOTA (ketua, sekretaris) =====
    Route::middleware('role:ketua,sekretaris')->prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', [AnggotaController::class, 'index'])->name('index');
        Route::get('/create', [AnggotaController::class, 'create'])->name('create');
        Route::post('/', [AnggotaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AnggotaController::class, 'edit'])->whereNumber('id')->name('edit');
        Route::put('/{id}', [AnggotaController::class, 'update'])->whereNumber('id')->name('update');
    });

    // ===== IURAN =====
    Route::get('/iuran', [IuranController::class, 'index'])
        ->middleware('role:ketua,bendahara')->name('iuran.index');
    Route::put('/iuran/{id}', [IuranController::class, 'update'])
        ->whereNumber('id')->middleware('role:ketua')->name('iuran.update');
});