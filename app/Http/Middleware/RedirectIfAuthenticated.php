<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $userRole = Auth::guard($guard)->user()->role ?? null;
            return $this->redirectBasedOnRole($userRole);
        }

        return $next($request);
    }

    protected function redirectBasedOnRole($userRole)
    {
        return match ($userRole) {
            'manager', 'admin' => redirect('products'),
            default => redirect('/'),
        };
    }
}
