<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['sometimes', 'boolean'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($validated, $remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        if (!Auth::user()->hasVerifiedEmail()) {
            Auth::logout();
            return redirect()
                ->route('login')
                ->withErrors(['email' => __('auth.unverified')]);
        }

        return redirect()
            ->route('dashboard')
            ->with('status', __('auth.login_success'));
    }
}