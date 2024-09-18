<?php

use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

include 'auth.php';

Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard.index')->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('units', UnitController::class);

});

Route::view('/', 'welcome')->name('home');
