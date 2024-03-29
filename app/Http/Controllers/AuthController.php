<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function registerPage(){
        return view('auth.register');
    }

    public function authorization(){
        if (Auth::user()->role=='admin') {
           return redirect()->route('admin#dashboardPage');
        }else{
            return redirect()->route('user#profile');
        }
    }

    public function changePasswordPage(){
        if (Auth::user()->role=='admin') {
            return view('admin.account.changePassword');
        }
    }
}
