<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Produksi;
use App\Models\Penangkaran;
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
        ];

        return view('dashboard', $data);
    }

    // viewpenangkaran
    public function readpenangkaran()
    {
        $data = [
            'penangkarans' =>Penangkaran::all(),
        ];
        $cek=Penangkaran::count();
        if($cek==null){
            $urut= 1;
            $kode='PNK-0'. $urut;
        }else{
            $ambil=Penangkaran::all()->last();
            $urut=(int)substr($ambil->kode_penangkaran,-1) + 1;
            $kode='PNK-0'. $urut;
        }

        return view('penangkaran', $data,compact('kode'));
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
        $this->Penangkaran->insert($validatelokasi);

        return redirect()->route('penangkaran')->with('create', 'Berhasil Menambahkan');
    }
    public function detailkandang($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        $data = [
            'penangkarans' => Penangkaran::find($id),
            'categories' => Category::all(),
        ];
        //$kode = Penangkaran::get('kode_penangkaran');
        return view('readkandang', $data);
    }
    // detail penangkaran
    public function detailpenangkaran($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        $data = [
            'penangkarans' => Penangkaran::find($id),
            'categories' => Category::all(),
        ];
        //$kode = Penangkaran::get('kode_penangkaran');
        return view('detailkandang', $data);
    }
    // delete penangkaran
    public function deletepenangkaran($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        if(Penangkaran::find($id)->delete())
        {
            $this->Kandang->where('penangkaran_id', $id)->delete();
        }

        return redirect()->route('penangkaran')->with('delete', 'Data Berhasil di hapus');
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
    //view kandang
    public function readkandang()
    {
        $data=([
            'kandangs'=> Kandang::all(),
            'categories' => Category::all(),
            'penangkarans' => Penangkaran::all(),
        ]);
        return view('kandang',$data);
    }

    //create kandang
    public function createkandang(){
        $validatekandang = Request()->validate([
            'namakandang' =>'required',
            'category_id' =>'required',
            'penangkaran_id' =>'required'
            // 'kategori' =>'required|unique:categories',

        ],[
            'namakandang.required' => 'kode Harus di Isi',
            //'namakandang.unique' => 'Kode sudah ada',

            // 'kategori.required' => 'Lokasi Harus di Isi',
            // 'kategori.unique' => 'Lokasi telah ada',
        ]);
        $this->Kandang->insert($validatekandang);
        //$this->Kandang->createkandang($validatekandang);
        return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }
    //delete kandang
    public function deletekandang($id)
    {
        Kandang::find($id)->delete();
        return redirect()->back()->with('delete','Berhasil menghapus data kandang');
    }

    public function readreportproduksi(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi',$data);
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
