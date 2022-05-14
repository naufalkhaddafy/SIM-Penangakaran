<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kandang;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class PenangkaranController extends Controller
{
    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    // viewpenangkaran
    public function ReadPenangkaran()
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
    public function CreatePenangkaran()
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
        Penangkaran::create($validatelokasi);

        return redirect()->route('penangkaran')->with('create', 'Berhasil Menambahkan Penangkaran');
    }
    public function DetailKandang($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        $data = [
            'penangkarans' => Penangkaran::find($id),
        ];
        return view('readkandang', $data);
    }
    // detail penangkaran
    public function DetailPenangkaran($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        $data = [
            'penangkarans' => Penangkaran::find($id),
            'users' => User::all(),
        ];
        return view('kandang.kandang', $data);
    }
    // delete penangkaran
    public function DeletePenangkaran($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        Penangkaran::find($id)->forceDelete();
        return redirect()->route('penangkaran')->with('delete', 'Data Berhasil di hapus');
    }
}
