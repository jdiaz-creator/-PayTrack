<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordResetToken;
use Carbon\Carbon;

class AuthController extends Controller
{
    // ==========================================
    // DISPLAY LOGIN PAGE
    // ==========================================

    public function showLogin()
    {
        return view('auth.login');
    }

    // ==========================================
    // PROCESS LOGIN
    // ==========================================

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials['email'] = strtolower($credentials['email']);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/dashboard')
                ->with('success', 'Login successful! Welcome to PayTrack.');
        }

        return back()->withErrors([
            'email' => 'Invalid email address or password.',
        ])->onlyInput('email');
    }

    // ==========================================
    // DISPLAY FORGOT PASSWORD PAGE
    // ==========================================

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // ==========================================
    // DIRECT FORGOT PASSWORD
    // LOCAL DEVELOPMENT ONLY
    // ==========================================

    public function sendResetLink(Request $request)
    {
        if (!app()->environment('local')) {
            abort(403, 'Direct password reset is disabled.');
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = strtolower($validated['email']);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Administrator email not found.',
            ])->withInput($request->only('email'));
        }

        // User model automatically hashes the password
        $user->password = $validated['password'];
        $user->save();

        // Remove old reset tokens
        PasswordResetToken::where('email', $email)->delete();

        return redirect()->route('login')->with(
            'success',
            'Password successfully changed! You can now log in.'
        );
    }

    // ==========================================
    // DISPLAY RESET PASSWORD PAGE
    // LEGACY EMAIL RESET ROUTE
    // ==========================================

    public function showResetPassword(Request $request, $token)
    {
        $email = strtolower($request->query('email', ''));

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors([
                    'email' => 'Invalid reset link.',
                ]);
        }

        $resetRecord = PasswordResetToken::where(
            'email',
            $email
        )->first();

        if (
            !$resetRecord ||
            !hash_equals(
                $resetRecord->token,
                hash('sha256', $token)
            ) ||
            Carbon::parse($resetRecord->created_at)
                ->addMinutes(60)->isPast()
        ) {
            return redirect()->route('password.request')
                ->withErrors([
                    'email' => 'Invalid or expired reset link.',
                ]);
        }

        return view('auth.reset-password', compact('token', 'email'));
    }

    // ==========================================
    // PROCESS LEGACY PASSWORD RESET
    // ==========================================

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = strtolower($validated['email']);

        $resetRecord = PasswordResetToken::where(
            'email',
            $email
        )->first();

        if (
            !$resetRecord ||
            !hash_equals(
                $resetRecord->token,
                hash('sha256', $validated['token'])
            ) ||
            Carbon::parse($resetRecord->created_at)
                ->addMinutes(60)->isPast()
        ) {
            return back()->withErrors([
                'email' => 'Invalid or expired password reset link.',
            ]);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Administrator account not found.',
            ]);
        }

        $user->password = $validated['password'];
        $user->save();

        $resetRecord->delete();

        return redirect()->route('login')->with(
            'success',
            'Password successfully changed! Please log in.'
        );
    }

    // ==========================================
    // DISPLAY CHANGE PASSWORD PAGE
    // ==========================================

    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    // ==========================================
    // UPDATE PASSWORD WHILE LOGGED IN
    // ==========================================

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!Hash::check(
            $validated['current_password'],
            $user->password
        )) {
            return back()->withErrors([
                'current_password' => 'Incorrect current password.',
            ]);
        }

        // Automatically hashed by User model
        $user->password = $validated['password'];
        $user->save();

        return redirect()->route('password.change')
            ->with('success', 'Password successfully updated!');
    }

    // ==========================================
    // LOGOUT
    // ==========================================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'You have successfully logged out.');
    }
}
