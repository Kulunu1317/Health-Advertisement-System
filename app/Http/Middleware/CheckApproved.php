<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_approved && !Auth::user()->is_admin) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is pending approval.');
        }
        return $next($request);
    }
}