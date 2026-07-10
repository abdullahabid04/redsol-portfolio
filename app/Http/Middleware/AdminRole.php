<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        // All admins have all permissions — bypass check
        // When you add granular permissions later, uncomment the logic below:

        /*
        $admin = Auth::guard('admin')->user();

        foreach ($permissions as $permission) {
            if ($admin->can($permission)) {
                return $next($request);
            }
        }

        return $request->expectsJson()
            ? response()->json(['message' => 'Forbidden.'], 403)
            : abort(403, 'You do not have permission to access this page.');
        */

        return $next($request);
    }
}