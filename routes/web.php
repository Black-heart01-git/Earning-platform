<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Home page
Route::get('/', [UserController::class, 'index'])->name('home');

// User registration/login (handled by Laravel Auth or custom)
Auth::routes();

// User Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [UserController::class, 'tasks'])->name('tasks');
    Route::get('/spin', [UserController::class, 'spin'])->name('spin');
    Route::get('/mine', [UserController::class, 'mine'])->name('mine');
    Route::get('/wallet', [UserController::class, 'wallet'])->name('wallet');
    Route::post('/activate', [UserController::class, 'activate'])->name('activate');
    Route::post('/withdraw', [UserController::class, 'withdraw'])->name('withdraw');
});

// Admin Panel
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('admin.withdrawals');
        Route::post('/approve-withdrawal/{id}', [AdminController::class, 'approveWithdrawal']);
    });
});
