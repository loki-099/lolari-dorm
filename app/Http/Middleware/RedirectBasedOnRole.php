<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Redirect authenticated users to the appropriate dashboard based on their role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated and trying to access home page or specific pages
        if (auth()->check()) {
            $path = $request->path();
            
            // Redirect from home if not already on a staff/admin page
            if ($path === '' || $path === 'home') {
                if (auth()->user()->hasRole('staff')) {
                    return redirect()->route('staff.dashboard');
                } else {
                    return redirect()->route('admin.dashboard');
                }
            }
        }

        return $next($request);
    }
}
