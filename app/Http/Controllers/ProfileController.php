<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show profile overview.
     */
    public function index(): View
    {
        return view('profile');
    }

    /**
     * Show edit profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's name or email.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile')->with('success', 'Profile updated!');
    }

    /**
     * Security settings view (change password).
     */
    public function security(): View
    {
        return view('profile.security');
    }

    /**
     * Handle password update.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }

        $request->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return Redirect::route('profile')->with('success', 'Password updated!');
    }

    /**
     * Delete user account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Account successfully deleted.');
    }
}
