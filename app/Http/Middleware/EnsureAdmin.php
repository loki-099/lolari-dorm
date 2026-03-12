<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     * Only allows users with admin role to access.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('home');
        }

        $user = auth()->user();

        // Check if user has admin role
        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin access only.');
        }

        return $next($request);
    }
}

