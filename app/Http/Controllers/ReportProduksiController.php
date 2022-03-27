<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class ReportProduksiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function report_inkubator(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('laporanproduksi.inkubator',$data);
    }
    public function report_hidup(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('laporanproduksi.hidup',$data);
    }
}
