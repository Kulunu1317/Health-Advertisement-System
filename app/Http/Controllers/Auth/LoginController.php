<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect()->intended('admin/dashboard');
            }
            if (!$user->is_approved) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is not approved yet.']);
            }
            return redirect()->intended('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}