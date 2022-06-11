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
    public function ModalRead($id)
    {
        $data = User::find($id);
        return view('pengguna.modal.read', compact('data'));
    }
    public function ModalCreate()
    {
        $penangkaran = Penangkaran::all();
        return view('pengguna.modal.create', compact('penangkaran'));
    }
    public function ModalUpdate($id)
    {
        $data = User::find($id);
        $penangkarans = Penangkaran::all();
        $role = [
            'Pemilik' => 'pemilik',
            'Pekerja' => 'pekerja',
        ];
        return view('pengguna.modal.update', compact('data', 'penangkarans', 'role'));
    }
    public function ModalDelete($id)
    {
        $data = User::find($id);
        $penangkarans = Penangkaran::all();
        return view('pengguna.modal.delete', compact('data', 'penangkarans'));
    }
    public function ReadTablePemilik()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.tablepemilik', $data);
    }
    public function ReadTablePekerja()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.tablepekerja', $data);
    }

    // nambah user
    public function CreateUser(Request $request)
    {
        $validateuser = $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users',
            //'nohp' =>'unique:users|min:12|max:14',
            'nohp' => 'required|unique:users',
            'password' => 'required|min:5',
            'role' => 'required',
            'penangkaran_id' => 'nullable',
        ], [
            'nama_lengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            'username.unique' => 'Username telah terdaftar',
            'role.required' => 'Role Harus di isi',

            'nohp.required' => 'No. Hp Harus di Isi',
            'nohp.unique' => 'No. Hp telah terdaftar',
            //'nohp.min' => 'Masukan No. Hp yang sesuai',
            //'nohp.max' => 'Masukan No. Hp yang sesuai',
            'password.required' => 'Password harus di Isi',
            'password.min' => 'Password minimal 5 Digit',
            'penangkaran_id.required' => 'Harus diisi',
        ]);

        $validateuser['password'] = Hash::make($validateuser['password']);
        User::create($validateuser);
        // return redirect()->back()->with('create','Berhasil menambahkan pengguna');
    }
    // hapus pengguna
    public function DeleteUser($id)
    {
        User::find($id)->delete();
        // return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }

    //update
    public function UpdateUser($id)
    {
        $nohp = User::find($id)->nohp;
        if ($nohp == Request()->nohp) {
            $validateuser = Request()->validate([
                'nama_lengkap' => 'required',
                'role' => 'required',
                'penangkaran_id' => 'nullable',
                //'nohp' =>'required|unique',

            ], [
                'nama_lengkap.required' => 'Nama Harus di Isi',
                'nohp.required' => 'No. Hp Harus di Isi',
                //'nohp.unique' => 'No. Hp telah terdaftar',
                // 'username.required' => 'Username Harus di Isi',
                //'penangkaran_id.required' =>'Harus diisi',
            ]);
        } else {
            $validateuser = Request()->validate([
                'nama_lengkap' => 'required',
                'role' => 'required',
                'penangkaran_id' => 'nullable',
                'nohp' => 'required|unique:users',
            ], [
                'nama_lengkap.required' => 'Nama Harus di Isi',
                'nohp.required' => 'No. Hp Harus di Isi',
                'nohp.unique' => 'No. Hp telah terdaftar',
                // 'username.required' => 'Username Harus di Isi',
                //'penangkaran_id.required' =>'Harus diisi',
            ]);
        }
        User::find($id)->update($validateuser);


        // return redirect()->back()->with('update','Data Berhasil di update');
    }
}
