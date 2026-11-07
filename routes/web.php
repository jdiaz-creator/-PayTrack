<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect homepage to login
Route::get('/', function () {
    return redirect('/login');
});

// Login Page
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Login Authentication
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

