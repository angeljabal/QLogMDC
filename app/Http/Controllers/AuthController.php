<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (auth()->check()) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user'     =>  'string|required',
            'password'  =>  'string|required',
        ]);

        $user = User::where('user', $request->user)->first();
        if (!$user) {
            return redirect('/login')->with('error', 'Account does not exist.');
        }
        $login = auth()->attempt([
            'user'      =>  $request->user,
            'password'  =>  $request->password
        ]);

        if (!$login) {
            return back()->with('error', 'Invalid Credentials');
        }
        return redirect('/dashboard');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->flush();
        return redirect('/');
    }
}