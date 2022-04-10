<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Category;
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
        $this->Category = new Category();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    //halaman dashboard
    public function readdashboard()
    {
        $data=[
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' =>Kandang::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];

        return view('dashboard', $data);
    }


    // kategori produksi
    public function readkategoriproduksi()
    {
        $data = [

            'categories' =>Category::all(),
        ];
        return view('kategoriproduksi',$data);
    }
    //view kategori
    public function readkategori()
    {
        $data = [
            'categories' =>Category::all(),
        ];
        $cek=Category::count();
        if($cek==null){
            $urut= 1;
            $kode='KTG-0'. $urut;
        }else{
            $ambil=Category::all()->last();
            $urut=(int)substr($ambil->kode_kategori,-1) + 1;
            $kode='KTG-0'. $urut;
        }
        return view('category',$data,compact('kode'));
    }
    //create kategori
    public function createkategori()
    {
        $validatekategori = Request()->validate([
            'kode_kategori' =>'required|unique:categories',
            'kategori' =>'required|unique:categories',

        ],[
            'kode_kategori.required' => 'kode Harus di Isi',
            'kode_kategori.unique' => 'Kode sudah ada',
            'kategori.required' => 'Kategori Harus di Isi',
            'kategori.unique' => 'Kategori telah ada',
        ]);

        $this->Category->insert($validatekategori);
        return redirect()->route('kategori')->with('create', 'Berhasil Menambahkan');
    }
    //delete kategori
    public function deletekategori($id)
    {
        Category::find($id)->delete();
        return redirect()->route('kategori')->with('delete', 'Kategori Berhasil di hapus');
    }

    //view pakan
    public function readpakan(){
        $data=([
            'pakans'=>Pakan::all(),
        ]);
        return view('pakan',$data);
    }
    //create pakan
    public function createpakan(){
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
    public function deletepakan($id){
        Pakan::find($id)->delete();
        return redirect()->back()->with('delete','Berhasil Menghapus Data Pakan');
    }
}
