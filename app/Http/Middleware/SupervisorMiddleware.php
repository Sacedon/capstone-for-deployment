<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupervisorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->role === 'supervisor') {
            return $next($request);
        }

        // Redirect or abort the request if the user doesn't have the 'superior' role
        return redirect()->route('dashboard')->with('error', 'Unauthorized. You must be an supervisor.');
    }
}
