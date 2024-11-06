<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $r){
        $cred = $r->validate([
            'username'=> 'required',
            'password'=>'required'
        ]);
        if(Auth::attempt($cred)){
            $r->session()->regenerate();
            return redirect()->intended('/user');
        }
        return back()->with('error',"Login Failed");
    }
}
