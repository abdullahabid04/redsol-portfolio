<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    // Max login attempts before lockout
    const MAX_ATTEMPTS = 5;

    // Lockout duration in seconds (15 minutes)
    const DECAY_SECONDS = 900;

    // ── Show login page ───────────────────────────────────────────────────

    public function showLogin(Request $request): View|RedirectResponse
    {
        // Already logged in → go straight to dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    // ── Handle login form submission ──────────────────────────────────────

    public function login(Request $request): RedirectResponse
    {
        // 1. Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Check rate limit — throttle by email + IP
        $throttleKey = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many login attempts. Please try again in {$minutes} minute(s).",
                ]);
        }

        // 3. Attempt authentication against the 'admin' guard
        $remember = $request->boolean('remember');

        if (!Auth::guard('admin')->attempt($credentials, $remember)) {
            // Wrong credentials — increment rate limiter
            RateLimiter::hit($throttleKey, self::DECAY_SECONDS);

            $remaining = self::MAX_ATTEMPTS - RateLimiter::attempts($throttleKey);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Invalid email or password. {$remaining} attempt(s) remaining.",
                ]);
        }

        // 4. Credentials correct — check account is active
        $admin = Auth::guard('admin')->user();

        if (!$admin->is_active) {
            // Log them back out immediately
            Auth::guard('admin')->logout();

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Your account has been deactivated. Please contact a super admin.',
                ]);
        }

        // 5. Successful login — clear rate limiter, regenerate session
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        // 6. Record last login timestamp
        $admin->recordLogin();

        return redirect()
            ->intended(route('admin.dashboard'))
            ->with('success', "Welcome back, {$admin->name}!");
    }

    // ── Logout ────────────────────────────────────────────────────────────

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }

    // ── Private helpers ───────────────────────────────────────────────────

    /**
     * Build the rate limiter key: email + IP address.
     * Keyed by both so different IPs can still be throttled per email.
     */
    private function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower($request->input('email')) . '|' . $request->ip()
        );
    }
}