<?php

namespace App\Http\Controllers;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Penangkaran;
use App\Models\Produksi;
use App\Models\User;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ModalRead($id)
    {
        $data = Kandang::find($id);
        return view('kandang.modal.read', compact('data'));
    }
    public function ModalCreate($id)
    {
        $penangkarans= Penangkaran::find($id);
        return view('kandang.modal.create',compact('penangkarans'));
    }
    public function ModalUpdate($id)
    {
        $data=Kandang::find($id);
        $penangkarans= Penangkaran::all();
        return view('kandang.modal.update', compact('data','penangkarans'));
    }
    public function ModalDelete($id)
    {
        $data = Kandang::find($id);
        $penangkarans= Penangkaran::all();
        return view('kandang.modal.delete', compact('data','penangkarans'));
    }
    public function ShowKandang($id)
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::find($id),
            'kandangs' => Kandang::all(),
        ];
        return view('kandang.show',$data);
    }
    //view kandang
    public function ReadKandang()
    {
        $data=([
            'kandangs'=> Kandang::all(),
            'penangkarans' => Penangkaran::all(),
        ]);
        return view('kandang',$data);
    }

    //create kandang
    public function CreateKandang(){
        $validatekandang = Request()->validate([
            'nama_kandang' =>'required',
            'kategori' =>'required',
            'penangkaran_id' =>'required'
            // 'kategori' =>'required|unique:categories',

        ],[
            'nama_kandang.required' => 'Nama Kandang Harus di Isi',
            'kategori.required' => 'Kategori Kandang Harus di Isi',
        ]);
        Kandang::create($validatekandang);

        // return redirect()->back()->with('create', 'Berhasil Menambahkan ');
    }
    public function UpdateKandang($id){
        $validatekandang = Request()->validate([
            'nama_kandang' =>'required',
            'kategori' =>'required',
            'penangkaran_id' =>'required'
        ],[
            'nama_kandang.required' => 'Nama Kandang Harus di Isi',
            'kategori.required' => 'Kategori Kandang Harus di Isi',
        ]);
        Kandang::find($id)->update($validatekandang);
    }
    //delete kandang
    public function DeleteKandang($id)
    {
        Kandang::find($id)->forceDelete();

        // return redirect()->back()->with('delete','Berhasil menghapus data kandang');
    }

    public function readreportproduksi(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi.inkubator',$data);
    }
    public function DetailKandang(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'kandangs'=>Kandang::all(),
            'users'=>User::all(),
        ]);
        return view('u_kandang',$data);
    }
    public function DetailKandangs($id){
        $data=([
            'kandangs' =>Kandang::find($id),
        ]);
        return view('kandang.riwayatkandang',$data);
    }
}
