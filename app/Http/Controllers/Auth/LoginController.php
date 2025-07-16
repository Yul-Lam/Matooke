<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // ✅ Required for middleware support
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // ✅ Applies guest middleware correctly
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Make sure this view exists
    }

    /**
     * Handle login submission.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            
            return redirect()->intended('/dashboard')
                 ->with('success', 'You have logged in successfully!');
        }
    }
}