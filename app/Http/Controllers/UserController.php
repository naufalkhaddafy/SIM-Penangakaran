<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kandang;
use App\Models\Penangkaran;
use App\Models\Category;

class UserController extends Controller
{
    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Category = new Category();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    //
    public function readuser()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.pengguna',$data);
    }
    // nambah user
    public function createuser(Request $request)
    {
        $validateuser= $request->validate([
            'namalengkap' =>'required',
            'username' =>'required|unique:users',
            //'nohp' =>'unique:users|min:12|max:14',
            'nohp' =>'unique:users',
            'password' =>'required|min:5',
            'level' =>'required',
            'penangkaran_id' =>'required',
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
            'penangkaran_id.required' =>'Harus diisi',
        ]);
        // if($validateuser->fails()) {

        //     return response()->json([
        //         'status'=> 400,
        //         'errors' =>$validateuser->messages(),
        //     ]);
        // }else{
        //     // $validateuser['password']=Hash::make($validateuser['password']);

        //     // User::create($validateuser);
        //     // $this->User = $this->input('namalengkap');
        //     // $this->User = $this->input('username');
        //     // $this->User = $this->input('nohp');
        //     // $this->User = $this->input('password');
        //     // $this->User = $this->input('penangkaran_id');
        //     // $this->User = $this->input('level');
        //     // $this->User->save();
        //     return response()->json([
        //         'status'=> 200,
        //     ])->with('create','Berhasil menambahkan pengguna');
        // }
        $validateuser['password']=Hash::make($validateuser['password']);
        User::create($validateuser);
        return redirect('pengguna')->with('create','Berhasil menambahkan pengguna');
    }
    // hapus pengguna
    public function deletepengguna($id)
    {
        User::find($id)->delete();
        return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }
    //update
    public function updateuser($id){

        $validateuser= Request()->validate([
            'namalengkap' =>'required',
            'username' =>'required',
            'level' =>'required',
            'penangkaran_id' =>'nullable',
            'nohp'=>'nullable',
        ],[
            'namalengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            //'penangkaran_id.required' =>'Harus diisi',
        ]);
        User::find($id)->update($validateuser);
        return redirect()->back()->with('update','Data Berhasil di update');
    }
}
