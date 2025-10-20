<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTsController;
use App\Http\Controllers\KasBankController;
use App\Http\Controllers\BendaharaDashboard;
use App\Http\Controllers\KategoriTsController;

// Redirect default ke login
Route::get('/', fn() => redirect('/login'));

// Auth routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// SUPER ADMIN
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/superadmin', fn() => view('pages.superadmin.dashboard'))->name('superadmin.dashboard');

    // USER
    Route::get('/superadmin/users', [UserController::class, 'baca'])->name('superadmin.users');
    Route::get('/superadmin/users/create', [UserController::class, 'create'])->name('superadmin.users.create');
    Route::post('/superadmin/users', [UserController::class, 'store'])->name('superadmin.users.store');
    Route::get('/superadmin/users/{id}/edit', [UserController::class, 'edit'])->name('superadmin.users.edit');
    Route::put('/superadmin/users/{id}', [UserController::class, 'update'])->name('superadmin.users.update');
    Route::delete('/superadmin/users/{id}', [UserController::class, 'destroy'])->name('superadmin.users.destroy');

    // AKUN 
    Route::get('/superadmin/akun', [AkunController::class, 'index'])->name('superadmin.akun');
    Route::get('/superadmin/akun/create', [AkunController::class, 'create'])->name('superadmin.akun.create');
    Route::post('/superadmin/akun', [AkunController::class, 'store'])->name('superadmin.akun.store');
    Route::get('/superadmin/akun/{id}/edit', [AkunController::class, 'edit'])->name('superadmin.akun.edit');
    Route::put('/superadmin/akun/{id}', [AkunController::class, 'update'])->name('superadmin.akun.update');
    Route::delete('/superadmin/akun/{id}', [AkunController::class, 'destroy'])->name('superadmin.akun.destroy');

    Route::resource('/superadmin/kategori-transaksi', KategoriTsController::class)->names([
    'index' => 'superadmin.kategori',
    'create' => 'superadmin.kategori.create',
    'edit' => 'superadmin.kategori.edit',
    'update' => 'superadmin.kategori.update',
    'destroy' => 'superadmin.kategori.destroy',
    'store' => 'superadmin.kategori.store',
]);
    Route::get('/superadmin/kategori-transaksi/search', [App\Http\Controllers\KategoriTsController::class, 'search'])
    ->name('superadmin.users.search');


}); 

// BENDAHARA
Route::middleware(['auth', 'role:bendahara'])->group(function () {
   Route::get('/bendahara/dashboard', [BendaharaDashboard::class, 'dashboard'])->name('bendahara.dashboard');
    // routes/web.php

// Bendahara (Read Only - Akun)
Route::prefix('bendahara')->group(function () {
    Route::get('/akun', [AkunController::class, 'index'])->name('bendahara.akun');
});

    Route::resource('/bendahara/transaksi', TransaksiController::class)->names([
        'index' => 'bendahara.transaksi',
        'create' => 'bendahara.transaksi.create',
        'store' => 'bendahara.transaksi.store',
        'edit' => 'bendahara.transaksi.edit',
        'update' => 'bendahara.transaksi.update',
        'destroy' => 'bendahara.transaksi.destroy',
    ]);
      
    Route::resource('/bendahara/detail-transaksi', DetailTsController::class)->names([
         'index' => 'bendahara.detailTs',
        'create' => 'bendahara.detailTs.create',
        'store' => 'bendahara.detailTs.store',
        'edit' => 'bendahara.detailTs.edit',
        'update' => 'bendahara.detailTs.update',
        'destroy' => 'bendahara.detailTs.destroy',
    ]);

     Route::prefix('bendahara')->group(function () {
    Route::resource('kas-bank', KasBankController::class)->names([
        'index' => 'bendahara.kasBank',
        'create' => 'bendahara.kasBank.create',
        'store' => 'bendahara.kasBank.store',
        'edit' => 'bendahara.kasBank.edit',
        'update' => 'bendahara.kasBank.update',
        'destroy' => 'bendahara.kasBank.destroy',
    ]);
});
     
});


// FINANCE
Route::middleware(['auth', 'role:keuangan'])->group(function () {
    Route::get('/keuangan', fn() => view('pages.keuangan.dashboard'))->name('keuangan.dashboard');
});



