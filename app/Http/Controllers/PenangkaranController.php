<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class PenangkaranController extends Controller
{
    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Category = new Category();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
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

        return redirect()->route('penangkaran')->with('create', 'Berhasil Menambahkan Penangkaran');
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
}
