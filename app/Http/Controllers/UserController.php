<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return Redirect::route('home');
        } else {
            return view('Login.index');
        }
    }

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'E-posta adresi alanı zorunludur.',
            'password.required' => 'Parola alanı zorunludur.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return  Redirect::route('home');
        }

        return back()->withErrors([
            'email' => 'Bu e-posta adresi ile kayıtlı kullanıcı bulunamadı.',
        ]);
    }

    public function logout(Request $request)
    {
       
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}