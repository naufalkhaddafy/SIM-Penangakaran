<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
use App\Models\Penangkaran;
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
}
