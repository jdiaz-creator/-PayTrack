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

// BASIC SESSION TEST
Route::get('/session-test', function (Request $request) {
    $visits = $request->session()->get('diagnostic_visits', 0) + 1;

    $request->session()->put('diagnostic_visits', $visits);

    return response()->json([
        'visits' => $visits,
        'session_driver' => config('session.driver'),
        'session_cookie' => config('session.cookie'),
        'session_secure' => config('session.secure'),
    ]);
});

// CSRF AND SESSION CONFIGURATION TEST
Route::get('/csrf-debug', function (Request $request) {
    return response()->json([
        'session_driver' => config('session.driver'),
        'session_started' => $request->session()->isStarted(),
        'session_cookie' => config('session.cookie'),
        'session_secure' => config('session.secure'),
        'session_domain' => config('session.domain'),
        'request_secure' => $request->isSecure(),
        'app_url' => config('app.url'),
    ]);
});

// SESSION PERSISTENCE TEST
Route::get('/session-persist-test', function (Request $request) {
    $previous = $request->session()->get('test_counter', 0);
    $current = $previous + 1;

    $request->session()->put('test_counter', $current);

    return response()->json([
        'previous' => $previous,
        'current' => $current,
        'session_id' => $request->session()->getId(),
    ]);
});

// HTTP HEADERS DIAGNOSTIC
Route::get('/headers-debug', function (Request $request) {
    $headersSent = headers_sent($file, $line);

    return response()->json([
        'headers_sent' => $headersSent,
        'headers_sent_file' => $headersSent ? $file : null,
        'headers_sent_line' => $headersSent ? $line : null,
        'session_driver' => config('session.driver'),
        'session_started' => $request->session()->isStarted(),
        'session_secure' => config('session.secure'),
        'request_secure' => $request->isSecure(),
    ]);
});
