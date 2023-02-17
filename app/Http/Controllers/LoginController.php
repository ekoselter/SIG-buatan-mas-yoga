<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //mengarahkan ke halaman login
    public function index(){
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    //melakukan autentikasi dari data username dan password yang diinputkan
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // jika salah autentikasi
        return back()->with('loginError','Login Failed');
    }

    //melakukan logout
    public function logout(Request $request){
        Auth::logout();

        $request->session() ->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
