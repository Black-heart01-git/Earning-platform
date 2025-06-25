<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These are the routes for your Naira Earning Platform
*/

// Public homepage
Route::get('/', [UserController::class, 'index'])->name('home');

// Laravel default auth routes
Auth::routes();

// USER ROUTES (must be logged in)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Tasks
    Route::get('/tasks', [UserController::class, 'tasks'])->name('tasks');
    Route::get('/complete-task/{id}', [UserController::class, 'completeTask'])->name('complete.task');

    // Wallet & Activation
    Route::get('/wallet', [UserController::class, 'wallet'])->name('wallet');
    Route::post('/activate', [UserController::class, 'activate'])->name('activate');
    Route::post('/withdraw', [UserController::class, 'withdraw'])->name('withdraw');

    // Deposits
    Route::get('/deposit', [UserController::class, 'depositPage'])->name('deposit.page');
    Route::post('/deposit', [UserController::class, 'submitDeposit'])->name('deposit.submit');

    // Lucky Spin
    Route::get('/spin', [UserController::class, 'spin'])->name('spin');
    Route::post('/spin', function () {
        return back()->with('success', 'You spun the wheel! Reward will be added soon.');
    })->name('spin.submit');

    // Mine Game
    Route::get('/mine', [UserController::class, 'mine'])->name('mine');
    Route::post('/mine', function () {
        return back()->with('success', 'Mine game played! Reward coming soon.');
    })->name('mine.submit');
});

// ADMIN ROUTES
Route::get('/admin', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'doLogin'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/deposits', [AdminController::class, 'deposits'])->name('admin.deposits');
Route::post('/admin/deposit/approve/{id}', [AdminController::class, 'approveDeposit'])->name('admin.deposit.approve');
Route::get('/admin/withdrawals', [AdminController::class, 'withdrawals'])->name('admin.withdrawals');
Route::post('/admin/withdrawal/approve/{id}', [AdminController::class, 'approveWithdrawal'])->name('admin.withdrawal.approve');

// Admin logout
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
