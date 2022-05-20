<?php

namespace App\Http\Controllers;

use App\Models\Indukan;
use App\Models\Produksi;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class HasilProduksiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ReportInkubator()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('laporanproduksi.inkubator', $data);
    }
    public function ReportHidup()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporanproduksi.hidup', $data, compact('tgl_today'));
    }
    public function ReportMati()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('laporanproduksi.mati', $data);
    }
    public function ReportIndukan()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
            'indukans' => Indukan::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporanproduksi.indukan', $data, compact('tgl_today'));
    }
    public function CreateIndukan()
    {
        $validateindukan = Request()->validate([
            'kode_ring' => 'required|unique:produksis',
            'jenis_kelamin' => 'required',
            'keterangan' => 'nullable',
            'status_produksi' => 'required',
        ], [
            'kode_ring.required' => 'Kode Ring Harus di Isi',
            'kode_ring.unique' => 'Kode Ring Telah Ada',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus di Isi',
            'status_produksi.required' => 'Role Harus di isi',
        ]);
        Produksi::create($validateindukan);
        return redirect()->back();
    }
}
