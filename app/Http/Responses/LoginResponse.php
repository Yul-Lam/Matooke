<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request){
         $user = $request->user();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard'); // ✅ admin route

    }
    
      
    // Redirect based on role (if needed)
        if ($user->role === 'retailer') {
            return redirect()->route('retailer.dashboard');
        } elseif ($user->role === 'cooperative') {
            return redirect()->route('cooperative.dashboard');
        } elseif ($user->role === 'wholesaler') {
            return redirect()->route('wholesaler.dashboard');
        }

          return redirect()->route('dashboard'); // fallback


}
}

