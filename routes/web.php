<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// gust routes

Route::middleware(['guest'])->group(function () {
     
    // authentication (login)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post ('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');


});

// auth routes

Route::middleware(['auth'])->group( function() {

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

