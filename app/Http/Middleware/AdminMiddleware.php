<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Check if the authenticated user is an admin
        if (!auth()->check() || auth()->user()->usertype !== 'admin') {
            return back()->with('error', 'Unauthorized access!');

        }

        return $next($request);
    }
}
