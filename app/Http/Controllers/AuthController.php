<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    function showLogin(){
        return view('auth.login');
    }

    function login(LoginRequest $request){
        $credentials = $request->validated();

        if (Auth::attempt($credentials , $request->input('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        session()->flash('error' , __('auth.failed'));

        return back()->withInput();
    }

    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
