<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            dd('Redirecting to login...'); 
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }
    
        return $next($request);
    }
        
}
