<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in → redirect to login
        if (!Auth::guard('admin')->check()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthenticated.'], 401)
                : redirect()->route('admin.login')->with('error', 'Please log in to access the admin panel.');
        }

        $admin = Auth::guard('admin')->user();

        // Account deactivated → force logout
        if (!$admin->is_active) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('error', 'Your account has been deactivated. Please contact support.');
        }

        // Optional: attach admin to request for convenience
        // $request->attributes->add(['admin' => $admin]);

        return $next($request);
    }
}