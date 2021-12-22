<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->User = new User();
        $this->middleware('auth');
    }
    //halaman dashboard
    public function index()
    {
        $data = User::get('id');
        $collection = count($data);
        return view('dashboard')->with('collection', $collection);
    }
    public function user()
    {
        $data = [
            'users' => $this->User->allData(),
        ];
        return view('pengguna',$data);
    }
    public function createuser(Request $request)
    {
        $validateuser=$request->validate([
            'namalengkap' =>'required',
            'username' =>'required|unique:users',
            //'nohp' =>'unique:users|min:12|max:14',
            'nohp' =>'unique:users',
            'password' =>'required|min:5',
            'level' =>'required',
        ],[
            'namalengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            'username.unique' => 'Username telah terdaftar',
            //'nohp.required' => 'No. Hp Harus di Isi',
            'nohp.unique' => 'No. Hp telah terdaftar',
            //'nohp.min' => 'Masukan No. Hp yang sesuai',
            //'nohp.max' => 'Masukan No. Hp yang sesuai',
            'password.required' =>'Password harus di Isi',
            'password.min' =>'Password minimal 5 Digit',
        ]);
        $validateuser['password']=Hash::make($validateuser['password']);
        User::create($validateuser);
        return redirect('pengguna')->with('create','Berhasil menambahkan pengguna');
    }

    public function delete($id){

        $this->User->hapus_pengguna($id);
        return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }
}
