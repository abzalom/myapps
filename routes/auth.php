<?php

/**
 * Auth and Hendle Authorization
 */

use App\Http\Controllers\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthSessionController::class, 'login'])->name('auth.login');
    Route::post('/auth/login', [AuthSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/auth/logout', [AuthSessionController::class, 'logout'])->name('auth.logout');
});
