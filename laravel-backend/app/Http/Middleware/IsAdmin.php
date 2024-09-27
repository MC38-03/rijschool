<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    // public function handle(Request $request, Closure $next)
    // {
    //     if (auth()->check()) {
    //         \Log::info('Authenticated User:', [auth()->user()]);
    //     } else {
    //         \Log::info('User not authenticated');
    //     }
    
    //     if (auth()->check() && auth()->user()->role === 'admin') {
    //         return $next($request);
    //     }
    
    //     // If not authorized, redirect to home or show 403 error
    //     \Log::info('User Role:', [auth()->user()->role ?? 'No role found']);
    //     return redirect('/')->with('error', 'Unauthorized access.');
    // }
    
}

