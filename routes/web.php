<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;

/*
|--------------------------------------------------------------------------
| JOLERY PAYROLL MANAGEMENT SOLUTIONS
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ADMIN LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// LOGIN SUBMISSION
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// FORGOT PASSWORD
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

// RESET PASSWORD
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // ADMIN DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CHANGE ADMIN PASSWORD
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])
        ->name('password.change');

    Route::put('/change-password', [AuthController::class, 'updatePassword'])
        ->name('password.change.update');

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // EMPLOYEE MANAGEMENT
    Route::resource('employees', EmployeeController::class);

    // PAYROLL MANAGEMENT
    Route::get('/payrolls', [PayrollController::class, 'index'])
        ->name('payrolls.index');

    Route::get('/payrolls/create', [PayrollController::class, 'create'])
        ->name('payrolls.create');

    Route::post('/payrolls', [PayrollController::class, 'store'])
        ->name('payrolls.store');

    Route::get('/payrolls/{payroll}/edit', [PayrollController::class, 'edit'])
        ->name('payrolls.edit');

    Route::put('/payrolls/{payroll}', [PayrollController::class, 'update'])
        ->name('payrolls.update');

    Route::delete('/payrolls/{payroll}', [PayrollController::class, 'destroy'])
        ->name('payrolls.destroy');

    // APPROVE PAYROLL
    Route::post('/payrolls/{payroll}/approve', [PayrollController::class, 'approve'])
        ->name('payrolls.approve');

    // MARK PAYROLL AS PAID
    Route::post('/payrolls/{payroll}/mark-paid', [PayrollController::class, 'markPaid'])
        ->name('payrolls.markPaid');

});

/*
|--------------------------------------------------------------------------
| TEMPORARY SESSION DIAGNOSTICS
| Remove all diagnostic routes after troubleshooting.
|--------------------------------------------------------------------------
*/

