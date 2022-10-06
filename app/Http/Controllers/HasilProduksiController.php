<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Indukan;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Events\NotifUser;
use App\Models\Penangkaran;
use App\Models\Notification;
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
    public function ReportTerjual()
    {
        $produksis = Produksi::all();
        return view('laporan_produksi.terjual', compact('produksis'));
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
        $produksis = Produksi::all();
        return view('laporan_produksi.data.mati', compact('produksis'));
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
    public function ModalReadProduksi($id)
    {
        $data = Produksi::findOrFail($id);
        return view('laporan_produksi.modal.read', compact('data'));
    }
    public function ModalUpdateReportIndukan($id)
    {
        $data = Produksi::find($id);
        $jk = [
            'Jantan' => 'Jantan',
            'Betina' => 'Betina',
        ];
        $status = [
            'Hidup' => 'Hidup',
            'Mati' => 'Mati',
            'Indukan' => 'Indukan',
            'Terjual' => 'Terjual',
        ];
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang

        return view('laporan_produksi.modal.update', compact('data', 'jk', 'status', 'tgl_today'));
    }
    public function ModalUpdateReportHidup()
    {
        return view('laporan_produksi.modal.update_hidup');
    }

    public function ModalPrintHidup()
    {
        $penangkarans =  Penangkaran::all();
        return view('laporan_produksi.modal.print_hidup', compact('penangkarans'));
    }
    public function ModalPrintMati()
    {
        $penangkarans =  Penangkaran::all();
        return view('laporan_produksi.modal.print_mati', compact('penangkarans'));
    }

    public function CreateIndukan()
    {
        $validateindukan = Request()->validate([
            'kode_ring' => 'required|unique:produksis',
            'indukan' => 'nullable',
            'tgl_menetas' => 'nullable',
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
        $users = User::where('role', 'pemilik')->get();
        foreach ($users as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Indukan Baru',
                'message' => auth()->user()->nama_lengkap . ' menambahkan data indukan burung ' . Request()->kode_ring,
            ]);
            event(new NotifUser($notif));
        }
    }
    public function UpdateIndukan($id)
    {
        $produksi = Produksi::find($id);
        $validate = Request()->validate(
            [
                'kode_ring' => 'nullable',
                'indukan' => 'nullable',
                'tgl_menetas' => 'nullable',
                'jenis_kelamin' => 'required',
                'keterangan' => 'nullable',
                'status_produksi' => 'required',
            ],
            [
                // 'kode_ring.required' => 'Kode Ring Harus di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Harus di Isi',
                'status_produksi.required' => 'Role Harus di isi',
            ],
        );
        if (Request()->status_produksi == 'Mati') {
            $validate = Request()->validate([
                'kode_ring' => 'required',
                'indukan' => 'nullable',
                'tgl_menetas' => 'nullable',
                'jenis_kelamin' => 'required',
                'keterangan' => 'required',
                'status_produksi' => 'required',
            ], [
                'keterangan.required' => 'Keterangan harus di isi !!!',
                'kode_ring.required' => 'Kode Ring Harus di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Harus di Isi',
                'status_produksi.required' => 'Status Harus di isi',
            ]);
        }
        Produksi::find($id)->update($validate);
        //notifications
        if ($produksi->kandang_id == null) {
            $users = User::where('role', 'pemilik')->get();
            foreach ($users as $user) {
                $notif = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'Data Burung diubah',
                    'message' => auth()->user()->nama_lengkap . ' mengubah data indukan burung ' . $produksi->kode_ring,
                ]);
                event(new NotifUser($notif));
            }
        } else {
            $users = User::where('role', 'pemilik')->orWhere('penangkaran_id', $produksi->kandang->penangkaran_id ?? null)->get();
            foreach ($users as $user) {
                $notif = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'Data Burung diubah',
                    'message' => auth()->user()->nama_lengkap . ' mengubah data burung ' . $produksi->kode_ring . ' pada penangkaran ' . $produksi->kandang->penangkaran->lokasi_penangkaran,
                ]);
                event(new NotifUser($notif));
            }
        }
    }

    public function PrintLaporanProduksiMati($penangkaran, $startDate, $endDate)
    {
        $penangkarans = Penangkaran::find($penangkaran);

        if ($penangkaran == 'Penangkarans') {
            $data = Produksi::whereBetween('tgl_bertelur', [$startDate, $endDate])->where('status_produksi', 'Mati')->get();
        } else {
            $kandang = Kandang::where('penangkaran_id', $penangkaran)->get();
            //get produksis based on kandang
            $data = Produksi::whereIn('kandang_id', $kandang->pluck('id'))->whereBetween('tgl_bertelur', [$startDate, $endDate])->where('status_produksi', 'Mati')->get();
        }
        $startDate = $startDate;
        $endDate = $endDate;
        return view('print.produksi_mati', compact('data', 'startDate', 'endDate', 'penangkarans'));
        // $data = Produksi::whereBetween('tgl_bertelur', [$dateStart, $dateEnd])->get();
    }
    public function PrintLaporanProduksiHidup($penangkaran, $startDate, $endDate)
    {
        $penangkarans = Penangkaran::find($penangkaran);
        if ($penangkaran == 'Penangkarans') {
            $data = Produksi::whereBetween('tgl_bertelur', [$startDate, $endDate])->where('status_produksi', 'Hidup')->orWhere('status_produksi', 'Inkubator')->get();
        } else {
            $kandang = Kandang::where('penangkaran_id', $penangkaran)->get();
            //get produksis and get value status_produksi == hidup or inkubator based on kandang id
            $data = Produksi::whereIn('kandang_id', $kandang->pluck('id'))->whereBetween('tgl_bertelur', [$startDate, $endDate])->where([['status_produksi', '!=', 'Mati'], ['status_produksi', '!=', 'Indukan'], ['status_produksi', '!=', 'Terjual']])->get();
        }

        $startDate = $startDate;
        $endDate = $endDate;
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('print.produksi_hidup', compact('data', 'startDate', 'endDate', 'penangkarans', 'tgl_today'));
        // $data = Produksi::whereBetween('tgl_bertelur', [$dateStart, $dateEnd])->get();
    }
    public function PrintSertifikat($id)
    {
        $data = Produksi::find($id);
        return view('print.sertifikat', compact('data'));
    }
}
