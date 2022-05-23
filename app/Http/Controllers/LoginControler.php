<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControler extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login.login',$data);
        
    }

    public function aksiLogin(Request $r)
    {
        $data = [
            'username' => $r->username,
            'password' => $r->password,
        ];

        if(Auth::attempt($data)){
            $r->session()->regenerate();
            $r->session()->put('login', 1);
            $r->session()->put('nama', Auth::user()->nama);
            return redirect()->intended('dashboard');
        } else {
            return redirect('/')->with('error', 'Username / Password Salah!');
        }
    }

    public function logout(Request $r)
    {
        Auth::logout();

        return redirect('/');
    }

}
