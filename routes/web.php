<?php

use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\GCashAccountController;
use App\Http\Controllers\MayaAccountController;
use App\Http\Controllers\MayaTransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaTransactionController;
use App\Http\Controllers\SavingsAccountController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/savings-accounts', SavingsAccountController::class);
    Route::resource('/sa-transactions', SaTransactionController::class);
    Route::resource('/credit-cards', CreditCardController::class);
    Route::resource('/maya-accounts', MayaAccountController::class);
    Route::resource('/maya-transactions', MayaTransactionController::class);
    Route::resource('/gcash-accts', GCashAccountController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
