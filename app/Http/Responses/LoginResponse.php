<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        $user = auth()->user();
        
        // Redirect staff users to staff dashboard
        if ($user->hasRole('staff')) {
            return redirect()->intended(route('staff.dashboard'));
        }
        
        // Redirect other users to admin dashboard
        return redirect()->intended(route('admin.dashboard'));
    }
}
