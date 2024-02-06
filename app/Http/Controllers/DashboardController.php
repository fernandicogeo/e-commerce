<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function logout()
    {
        $redirect = "";

        if (Auth::user()->role === "admin") {
            $redirect = 'login';
        } else {
            $redirect = 'home';
        }

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route($redirect));
    }
}
