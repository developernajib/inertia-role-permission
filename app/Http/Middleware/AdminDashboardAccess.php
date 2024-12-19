<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;
use Auth;

class AdminDashboardAccess
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
        // Get the authenticated user
        $user = Auth::user()->load('roles');

        // Check if the user has the 'user' role or no roles
        if ($user && ($user->hasRole('user') || $user->roles->isEmpty())) {
            // If the user is unauthorized, return a 403 or redirect
            return Inertia::render('Errors/Forbidden')->toResponse($request);
        }

        // Allow access
        return $next($request);
    }
}
