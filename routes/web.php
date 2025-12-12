<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\Auth\ClientAuthController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| Apartments (Public)
|--------------------------------------------------------------------------
*/

Route::prefix('apartments')->name('apartments.')->group(function () {
    Route::get('/', [ApartmentController::class, 'index'])->name('index');
    Route::get('/{apartment:slug}', [ApartmentController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Authentication (Client)
|--------------------------------------------------------------------------
*/

// Guest Only (to prevent logged-in clients from seeing login/register again)
Route::middleware('guest:client')->group(function () {

    Route::view('/login', 'auth.login')->name('login.form');
    Route::view('/register', 'auth.register')->name('register.form');

    Route::post('/login', [ClientAuthController::class, 'login'])->name('login');
    Route::post('/register', [ClientAuthController::class, 'register'])->name('register');

    // Google OAuth
    Route::get('/google/redirect', [ClientAuthController::class, 'redirectToGoogle'])
        ->name('google.redirect');

    Route::get('/google/callback', [ClientAuthController::class, 'handleGoogleCallback'])
        ->name('google.callback');
});

/*
|--------------------------------------------------------------------------
| Authenticated Client Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:client')->group(function () {

    Route::post('/logout', [ClientAuthController::class, 'logout'])
        ->name('logout');

    // Future: dashboard, profile, bookings, etc.
    // Route::get('/profile', [...])->name('profile');
});
