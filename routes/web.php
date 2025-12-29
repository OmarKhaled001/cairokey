<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\Auth\ClientAuthController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('search', [HomeController::class, 'search'])->name('search');
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
| Cars (Public)
|--------------------------------------------------------------------------
*/
Route::prefix('cars')->name('cars.')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/{car:slug}', [CarController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Hotels (Public)
|--------------------------------------------------------------------------
*/
Route::prefix('hotels')->name('hotels.')->group(function () {
    Route::get('/', [HotelController::class, 'index'])->name('index');
    Route::get('/{hotel:slug}', [HotelController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Services (Public)
|--------------------------------------------------------------------------
*/
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{service:slug}', [ServiceController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Offers (Public)
|--------------------------------------------------------------------------
*/
Route::prefix('offers')->name('offers.')->group(function () {
    Route::get('/', [\App\Http\Controllers\OfferController::class, 'index'])->name('index');
    Route::get('/{offer:slug}', [\App\Http\Controllers\OfferController::class, 'show'])->name('show');
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
