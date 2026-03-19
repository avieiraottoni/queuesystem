<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// gust routes

Route::middleware(['guest'])->group(function () {
     
    // authentication (login)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post ('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');


});

// auth routes

Route::middleware(['auth'])->group( function() {

    Route::get('/', [MainController::class, 'index'])->name('home');

    // queue details
    Route::get('/queue/{id}', [MainController::class, 'queueDetails'])->name('queue.details');
    // Change password
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [AuthController::class, 'changePasswordSubmit'])->name('change.password.submit');
    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

