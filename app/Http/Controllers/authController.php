<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    function showLogin(){
        return(view('login'));
    }

    function submitLogin(Request $request){
        $data = $request->only('email','password');

        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }else{
            return redirect()->back()->with('failed', 'Wrong Email or Password');
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('/');
    }
}
