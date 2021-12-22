<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Penangkaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Category = new Category();
        $this->middleware('auth');
    }
    //halaman dashboard
    public function index()
    {
        // $data = User::get('id');
        // $lokasi = Penangkaran::get('id');
        // $collection = count($data);
        // $collection2 = count($lokasi);
        $data=[
            'users' => $this->User->allData(),
            'penangkarans' => $this->Penangkaran->readlokasi(),
        ];

        return view('dashboard', $data);
    }
    //view pengguna
    public function user()
    {
        $data = [
            'users' => $this->User->allData(),
        ];
        return view('pengguna',$data);
    }
    // nambah user
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
    // hapus pengguna
    public function deletepengguna($id)
    {

        $this->User->hapus_pengguna($id);
        return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }
    // viewpenangkaran
    public function viewpenangkaran()
    {
        $data = [

            'penangkarans' => $this->Penangkaran->readlokasi(),
        ];

        return view('penangkaran', $data);
    }
    // create penangkaran
    public function createpenangkaran()
    {
        $validatelokasi = Request()->validate([
            'kode_penangkaran' =>'required|unique:penangkarans',
            'lokasi_penangkaran' =>'required|unique:penangkarans',

        ],[
            'kode_penangkaran.required' => 'kode Harus di Isi',
            'kode_penangkaran.unique' => 'Kode sudah ada',
            'lokasi_penangkaran.required' => 'Lokasi Harus di Isi',
            'lokasi_penangkaran.unique' => 'Lokasi telah ada',
        ]);
        $this->Penangkaran->tambahlokasipenangkaran($validatelokasi);

        return redirect()->route('penangkaran')->with('create', 'Berhasil Menambahkan');
    }

    public function detailpenangkaran()
    {
        $data = [
            'penangkarans' =>$this->Penangkaran->readlokasi(),
        ];
        $kode = Penangkaran::get('kode_penangkaran');
        return view('kandang', [$data,$kode]);
    }
    //view kategori
    public function readkategori()
    {
        $data = [
            'categories' => $this->Category->readkategori(),
        ];
        return view('category',$data);
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
            'kategori.required' => 'Lokasi Harus di Isi',
            'kategori.unique' => 'Lokasi telah ada',
        ]);
        $this->Category->createkategori($validatekategori);

        return redirect()->route('kategori')->with('create', 'Berhasil Menambahkan');
    }
    public function deletekategori($id)
    {
        $this->Category->deletekategori($id);
        return redirect()->route('kategori')->with('delete', 'Kategori Berhasil di hapus');
    }

}
