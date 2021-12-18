<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //halaman login
    public function viewlogin()
    {
        return view('auth/login');
    }
    //halaman register
    public function viewregister()
    {
        return view('auth/register');
    }
    public function createuser(Request $request)
    {
        $validateuser=$request->validate([
            'namalengkap' =>'required',
            'username' =>'required|unique:users',
            'nohp' =>'required|unique:users|min:12|max:14',
            'password' =>'required|min:5',
            'level' =>'required',
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
        $validateuser['password']=Hash::make($validateuser['password']);
        User::create($validateuser);
        return redirect('/login');
    }
    public function login(Request $request)
    {
        $validatelogin=$request->validate([
            'username' =>'required',
            'password' =>'required',
        ],[
            'username.required' => 'Username Harus di Isi',
            'password.required' =>'Password harus di Isi',
        ]);
        if(Auth::attempt($validatelogin)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('login','Login Berhasil');
        }

        return back()->withErrors([
            //'username'=>'Periksa kembali',
            'password' => 'Periksa Kembali',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
