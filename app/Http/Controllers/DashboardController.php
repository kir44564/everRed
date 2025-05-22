<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with user list.
     */
    public function index(): View
    {
        $users = User::all();
        
        return view('dashboard', compact('users'));
    }
}