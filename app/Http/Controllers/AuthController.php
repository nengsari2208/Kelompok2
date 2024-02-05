<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $pesan = [
            'required' => 'Kolom :attribute harus diisi'
        ];

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], $pesan);


        if(auth()->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors('Email atau Password tidak sesuai');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
 
        return redirect('/login');
    }
}
