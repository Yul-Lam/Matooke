<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle login form submission.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

           if (Auth::attempt($credentials, $remember)) {
            // Redirect to dashboard or home
            return redirect()->intended('/dashboard');
        }

        // Failed login
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }
}
