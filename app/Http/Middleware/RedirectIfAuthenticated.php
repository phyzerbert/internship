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
            if (Auth::user()->hasRole('pupil')) {
                return redirect()->route('pupil.searchView');
            }

            if (Auth::user()->hasRole('company')) {
                return redirect()->route('company.requestsView');
            }

            if (Auth::user()->hasRole('teacher')) {
                return redirect()->route('teacher.pupilsView');
            }
        }

        return $next($request);
    }
}
