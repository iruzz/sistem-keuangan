<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Redirect default ke login
Route::get('/', fn() => redirect('/login'));

// Auth routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// SUPER ADMIN
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/superadmin', fn() => view('pages.superadmin.dashboard'))->name('superadmin.dashboard');
    Route::get('/superadmin/users', [UserController::class, 'baca'])->name('superadmin.users');
    Route::get('/superadmin/users/create', [UserController::class, 'create'])->name('superadmin.users.create');
    Route::post('/superadmin/users', [UserController::class, 'store'])->name('superadmin.users.store');

}); 

// ACCOUNTING
Route::middleware(['auth', 'role:accounting'])->group(function () {
    Route::get('/accounting', fn() => view('pages.accounting.dashboard'))->name('accounting.dashboard');
});

// FINANCE
Route::middleware(['auth', 'role:finance'])->group(function () {
    Route::get('/finance', fn() => view('finance.dashboard'))->name('finance.dashboard');
});

// HRD
Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/hrd', fn() => view('hrd.dashboard'))->name('hrd.dashboard');
});

// EMPLOYEE
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee', fn() => view('employee.dashboard'))->name('employee.dashboard');
});


