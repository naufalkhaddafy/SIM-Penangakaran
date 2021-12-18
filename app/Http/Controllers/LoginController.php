<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //halaman login
    public function login()
    {
        return view('auth/login');
    }
    //halaman register
    public function register()
    {
        return view('auth/register');
    }
}
