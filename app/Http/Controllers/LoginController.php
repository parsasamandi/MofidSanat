<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    // Show Login login
    public function index() {
        return view('login');
    }

    // Store Login
    public function store(Request $request) {
        request()->validate([
            'email' => 'required',
            'password' => 'min:8|required'
        ]);
        
        // Remember Token
        $remember = $request->get('remember_me');

        $remember_me = false;
        if(isset($remember)) {
            $remember_me = true;
        }

        // Auth
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(($credentials), $remember_me)) {
            // Authentication passed...
            return redirect()->intended('/adminHome');
        }
        return back()->with('faliure', 'رمز عبور یا ایمیل شما نادرست است');
    }
    
    //logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('login');
    }

}   
