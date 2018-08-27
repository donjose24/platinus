<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect('/admin');
            }

            if ($user->hasRole('customer')) {
                return redirect('/customer');
            }

            if ($user->hasRole('cashier')) {
                return redirect('/cashier');
            }
        }

        return $next($request);
    }
}
