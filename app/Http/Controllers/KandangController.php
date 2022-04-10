<?php

namespace App\Http\Controllers;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Penangkaran;
use App\Models\Produksi;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'nama_kandang' =>'required',
            'kategori' =>'required',
            'penangkaran_id' =>'required'
            // 'kategori' =>'required|unique:categories',

        ],[
            'nama_kandang.required' => 'kode Harus di Isi',
            //'nama_kandang.unique' => 'Kode sudah ada',

            // 'kategori.required' => 'Lokasi Harus di Isi',
            // 'kategori.unique' => 'Lokasi telah ada',
        ]);
        Kandang::create($validatekandang);
        //$this->Kandang->createkandang($validatekandang);
        return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }
    //delete kandang
    public function deletekandang($id)
    {
        Kandang::find($id)->forceDelete();
        return redirect()->back()->with('delete','Berhasil menghapus data kandang');
    }

    public function readreportproduksi(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi.inkubator',$data);
    }
    public function detail_kandang(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'kandangs'=>Kandang::all(),
        ]);
        return view('u_kandang',$data);
    }
    public function detail_kandangs($id){
        $data=([
            'Kandangs' =>Kandang::find($id),
        ]);
        return view('kandang.kandang',$data);
    }
}
