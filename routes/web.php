<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('login');
    })->name('login');

    Route::post('login', [LoginController::class, 'login'])->name('login.attempt');
    
    Route::view('register', 'register')->name('register');
    Route::post('register', RegisterController::class)->name('register.store');
});

// Email Verification Routes
Route::middleware('signed')->group(function () {
    Route::get('/auth/verify-email/{id}/{hash}', function ($id, $hash) {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json(['message' => 'Email verified successfully!']);
    })->name('verification.verify');
});

Route::post('/auth/resend-verification', function (Request $request) {
    $user = User::where('email', $request->email)->firstOrFail();

    if ($user->hasVerifiedEmail()) {
        abort(400, 'Email already verified.');
    }

    $user->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link resent!']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::post('logout', function () {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

