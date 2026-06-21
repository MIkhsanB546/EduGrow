<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\MateriController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/siswa', [StudentDashboardController::class, 'index'])->name('siswa.dashboard');

    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/materi/{materi}', [MateriController::class, 'show'])->name('materi.show');
    });

    Route::get('/', function () {
        $role = auth()->user()->role;

        return match ($role) {
            'siswa' => redirect('/siswa'),
            default => redirect('/dashboard'),
        };
    });
});
