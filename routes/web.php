<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkInstructionController;
use Illuminate\Support\Facades\Route;

include 'auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('units', UnitController::class);
    Route::resource('work-instructions', WorkInstructionController::class);
});

Route::view('/', 'welcome')->name('home');
