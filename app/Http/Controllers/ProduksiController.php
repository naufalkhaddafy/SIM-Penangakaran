<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
use App\Models\Penangkaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ProduksiInkubator(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi.inkubator',$data);
    }
    public function ProduksiHidup(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi.hidup',$data);
    }
    public function ProduksiMati(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi.mati',$data);
    }
    public function CreateProduksiTelur($id)
    {

        $validateproduksi = Request()->validate([
                'kandang_id' =>'required',
                'tgl_bertelur' =>'required',
                'status_telur' =>'required',
                'tgl_masuk_inkubator' =>'required',
            ],[
                'kandang_id.required' => 'Harus di Isi',
                'tgl_bertelur.required' => 'Harus di Isi',
                'status_telur.required' => 'Harus di Isi',
                'tgl_masuk_inkubator.required' => 'Harus di Isi',
            ]);
        Produksi::create($validateproduksi);
        
        $lastproduksi=Produksi::where('kandang_id', $id)->latest()->first();
        if($lastproduksi->status_telur =='pertama')
        {
            $tgl_akan_bertelur=date('Y-m-d', strtotime('+1 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas=date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));


        }elseif($lastproduksi->status_telur == 'kedua')
        {
            $tgl_akan_bertelur=date('Y-m-d', strtotime('+10 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas=date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));
        }else{
            abort(404);
        }
        $tambahjadwal = [
                'produksi_id' => $lastproduksi->id,
                'tgl_akan_bertelur' => $tgl_akan_bertelur,
                'tgl_akan_menetas' =>$tgl_akan_menetas,
            ];
            Jadwal::create($tambahjadwal);
        return redirect('produksi-inkubator')->with('create','Berhasil Menambahkan Produksi Telur');
    }
}
