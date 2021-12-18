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
    public function createuser(Request $request)
    {
        $request->validate([
            'namalengkap' =>'required',
            'username' =>'required|unique:users',
            'nohp' =>'required|unique:users|min:12|max:14',
            'password' =>'required|min:5',
        ],[
            'namalengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            'username.unique' => 'Username telah terdaftar',
            'nohp.required' => 'No. Hp Harus di Isi',
            'nohp.unique' => 'No. Hp telah terdaftar',
            'nohp.min' => 'Masukan No. Hp yang sesuai',
            'nohp.max' => 'Masukan No. Hp yang sesuai',
            'password.required' =>'Password harus di Isi',
            'password.min' =>'Password minimal 5 Digit',
        ]);
        dd('register berhasil');
    }
}
