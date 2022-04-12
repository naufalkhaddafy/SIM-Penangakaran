<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Penangkaran;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    //halaman dashboard
    public function ReadDashboard()
    {
        $data=[
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' =>Kandang::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];

        return view('dashboard', $data);
    }


    //view pakan
    public function ReadPakan(){
        $data=([
            'pakans'=>Pakan::all(),
        ]);
        return view('pakan',$data);
    }
    //create pakan
    public function CreatePakan(){
        $validatepakan = Request()->validate([
            'kode_tempat' =>'required',
            'nama_pakan' =>'required',
            'expired' =>'required',
            //'tgl_kadaluwarsa' =>'required',
            // 'kategori' =>'required|unique:categories',

        ],[
            'kode_tempat.required' => 'kode Harus di Isi',
            'nama_pakan.required' => 'Harus diisi',
            'expired.required' => 'Harus diisi',
        ]);
        Pakan::insert($validatepakan);
        return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }
    public function DeletePakan($id){
        Pakan::find($id)->delete();
        return redirect()->back()->with('delete','Berhasil Menghapus Data Pakan');
    }
}
