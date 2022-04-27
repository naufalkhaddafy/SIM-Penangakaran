<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Penangkaran;
use App\Models\Jadwal;
use App\Models\Produksi;
use App\Http\Controllers\Auth;
use App\Models\Kebersihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //halaman dashboard
    public function ReadDashboard()
    {
        $data=[
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' =>Kandang::all(),
            'jadwals' =>Jadwal::all(),
            'produksis' =>Produksi::all(),
            'kebersihan' =>Kebersihan::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];
        $produktif=auth()->user()->penangkaran->kandangs ??[];

        return view('dashboard', $data,compact('produktif'));
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
