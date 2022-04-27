<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kandang;
use App\Models\Penangkaran;


class UserController extends Controller
{
    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    //
    public function ReadUserPemilik()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.pemilik',$data);
    }
    public function ReadUserPekerja()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.pekerja',$data);
    }
    // nambah user
    public function CreateUser(Request $request)
    {
        $validateuser= $request->validate([
            'nama_lengkap' =>'required',
            'username' =>'required|unique:users',
            //'nohp' =>'unique:users|min:12|max:14',
            'nohp' =>'unique:users',
            'password' =>'required|min:5',
            'role' =>'required',
            'penangkaran_id' =>'nullable',
        ],[
            'nama_lengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            'username.unique' => 'Username telah terdaftar',
            //'nohp.required' => 'No. Hp Harus di Isi',
            'nohp.unique' => 'No. Hp telah terdaftar',
            //'nohp.min' => 'Masukan No. Hp yang sesuai',
            //'nohp.max' => 'Masukan No. Hp yang sesuai',
            'password.required' =>'Password harus di Isi',
            'password.min' =>'Password minimal 5 Digit',
            'penangkaran_id.required' =>'Harus diisi',
        ]);

        $validateuser['password']=Hash::make($validateuser['password']);
        User::create($validateuser);
        return redirect()->back()->with('create','Berhasil menambahkan pengguna');
    }
    // hapus pengguna
    public function DeleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }
    //update
    public function UpdateUser($id){

        $validateuser= Request()->validate([
            'nama_lengkap' =>'required',
            'username' =>'required',
            'role' =>'required',
            'penangkaran_id' =>'nullable',
            'nohp'=>'nullable',
        ],[
            'nama_lengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            //'penangkaran_id.required' =>'Harus diisi',
        ]);
        User::find($id)->update($validateuser);
        return redirect()->back()->with('update','Data Berhasil di update');
    }
}
