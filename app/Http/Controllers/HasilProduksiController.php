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
    public function ShowLaporanProduksiIndukan()
    {
        $produksis = Produksi::all();
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporan_produksi.data.indukan', compact('produksis', 'tgl_today'));
    }
    public function ShowLaporanProduksiHidup()
    {
        $produksis = Produksi::all();
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporan_produksi.data.hidup', compact('produksis', 'tgl_today'));
    }
    public function ShowLaporanProduksiMati()
    {
        return view('laporan_produksi.data.mati');
    }
    public function ShowLaporanProduksiInkubator()
    {
        $produksis = Produksi::all();
        return view('laporan_produksi.data.inkubator', compact('produksis'));
    }
    public function ShowLaporanProduksiTerjual()
    {
        return view('laporan_produksi.data.terjual');
    }
    public function ModalCreateIndukan()
    {
        return view('laporan_produksi.modal.create_indukan');
    }
    public function ModalUpdateReportIndukan()
    {
        return view('laporan_produksi.modal.update_indukan');
    }
    public function ModalUpdateReportHidup()
    {
        return view('laporan_produksi.modal.update_hidup');
    }
    public function ReportInkubator()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('laporan_produksi.inkubator', $data);
    }
    public function ReportHidup()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporan_produksi.hidup', $data, compact('tgl_today'));
    }
    public function ReportMati()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('laporan_produksi.mati', $data);
    }
    public function ReportIndukan()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
            'indukans' => Indukan::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporan_produksi.indukan', $data, compact('tgl_today'));
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
        // return redirect()->back();
    }
}
