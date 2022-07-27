<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Events\NotifUser;
use App\Models\Penangkaran;
use App\Models\Notification;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowProduksiInkubator()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('produksi.show_inkubator', $data);
    }
    public function ShowProduksiHidup()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('produksi.show_hidup', $data, compact('tgl_today'));
    }
    public function ShowProduksiMati()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('produksi.show_mati', $data, compact('tgl_today'));
    }
    public function ModalCreate($id)
    {
        $kandang = Kandang::find($id);
        $allIndukan = $kandang->indukans;
        $indukan = [];
        foreach ($allIndukan as $data) {
            $indukan[] = $data->produksi->kode_ring;
        }
        $formatIndukan = $indukan[0] . ' & ' . $indukan[1];
        return view('produksi.modal.create', compact('kandang', 'formatIndukan'));
    }
    public function ModalUpdateInkubator($id)
    {
        $data = Produksi::find($id);
        return view('produksi.modal.update_inkubator', compact('data'));
    }
    public function ModalUpdateHidup($id)
    {
        $data = Produksi::find($id);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        $jk = [
            'Jantan' => 'Jantan',
            'Betina' => 'Betina',
        ];
        return view('produksi.modal.update_hidup', compact('data', 'tgl_today', 'jk'));
    }
    public function ProduksiInkubator()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('produksi.inkubator', $data);
    }
    public function ProduksiHidup()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),

        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('produksi.hidup', $data, compact('tgl_today'));
    }
    public function ProduksiMati()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'produksis' => Produksi::all(),
        ]);
        return view('produksi.mati', $data);
    }
    public function CreateProduksiTelur()
    {
        $validateproduksi = Request()->validate([
            'kandang_id' => 'required',
            'tgl_bertelur' => 'required',
            'indukan' => 'required',
            'status_telur' => 'required',
            'tgl_masuk_inkubator' => 'required',
            'kode_tempat_inkubator' => 'required',
        ], [
            'kandang_id.required' => 'Kandang Tidak Terdeteksi',
            'tgl_bertelur.required' => 'Harus di Isi',
            'indukan.required' => 'Indukan Tidak Terdeteksi',
            'status_telur.required' => 'Status Telur Harus di Isi',
            'tgl_masuk_inkubator.required' => 'Harus di Isi',
            'kode_tempat_inkubator.required' => 'Kode Tempat Harus di Isi',
        ]);
        $kandang_id = Request()->kandang_id;
        $produksi = Produksi::create($validateproduksi);
        $lastproduksi = Produksi::where('kandang_id', $kandang_id)->latest()->first();
        if ($lastproduksi->status_telur == 'pertama') {
            $tgl_akan_bertelur_start = date('Y-m-d', strtotime('+1 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_bertelur_end = date('Y-m-d', strtotime('+2 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_start = date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_end = date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));
        } elseif ($lastproduksi->status_telur == 'kedua') {
            $tgl_akan_bertelur_start = date('Y-m-d', strtotime('+10 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_bertelur_end = date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_start = date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_end = date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));
        } elseif ($lastproduksi->status_telur == 'ketiga') {
            $tgl_akan_bertelur_start = date('Y-m-d', strtotime('+10 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_bertelur_end = date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_start = date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_end = date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));
        } else {
            abort(404);
        }
        $tambahjadwal = [
            'produksi_id' => $lastproduksi->id,
            'tgl_akan_bertelur_start' => $tgl_akan_bertelur_start,
            'tgl_akan_bertelur_end' => $tgl_akan_bertelur_end,
            'tgl_akan_menetas_start' => $tgl_akan_menetas_start,
            'tgl_akan_menetas_end' => $tgl_akan_menetas_end,
            'kode_tempat_inkubator' => Request()->kode_tempat_inkubator,
        ];
        Jadwal::create($tambahjadwal);
        Kandang::find($kandang_id)->update(['kategori' => 'Produktif']);
        // return redirect('produksi-inkubator')->with('create', 'Berhasil Menambahkan Produksi Telur');

        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', auth()->user()->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Telur Baru',
                'message' => auth()->user()->nama_lengkap . ' menambah telur di inkubator ' . Request()->kode_tempat_inkubator . ' pada penangkaran ' . auth()->user()->penangkaran->lokasi_penangkaran,
            ]);
            event(new NotifUser($notif));
        }
    }
    public function UpdateProduksiInkubator($id)
    {
        $validate = Request()->validate(
            [
                'status_produksi' => 'required',
            ],
            [
                'status_produksi.required' => 'Pilih Status Telur',
            ]
        );
        if (Request()->status_produksi == 'Hidup') {
            $dataproduksiinkubator = [
                'tgl_menetas' => Request()->tgl_menetas,
                'status_produksi' => 'Hidup',
            ];
        } elseif (Request()->status_produksi == 'Mati') {
            $data = Request()->validate([
                'keterangan' => 'required',
            ], [
                'keterangan.required' => 'Keterangan Harus di Isi',
            ]);
            $dataproduksiinkubator = [
                'tgl_menetas' => Request()->tgl_menetas,
                'status_produksi' => 'Mati',
                'keterangan' => Request()->keterangan,
            ];
        } else {
            abort(404);
        }
        Produksi::find($id)->update($dataproduksiinkubator);
        // return redirect('produksi-hidup')->with('update', 'Data Telur Hidup Berhasil di update');
        //notifications
        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', auth()->user()->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Telur diubah',
                'message' => auth()->user()->nama_lengkap . ' mengubah data telur dari inkubator ' . Request()->kode_tempat_inkubator . ' pada penangkaran ' . auth()->user()->penangkaran->lokasi_penangkaran,
            ]);
            event(new NotifUser($notif));
        }
    }
    public function UpdateProduksiHidup($id)
    {
        $input = Request()->kode_ring;
        // status Produksi
        if (Request()->status_produksi == 'Hidup') {
            // $produksis = Produksi::where([['kode_ring', '=', $input]])->first();
            // if ($input !== null) {
            //     if ($produksis !== null) {
            //         // $validate = Request()->validate([
            //         //     'kode_ring' => 'unique:produksis',
            //         // ], [
            //         //     'kode_ring.unique' => 'Kode Ring telah ada Periksa Kembali!!',
            //         // ]);
            //     }
            // }
            $dataproduksihidup = [
                'kode_ring' => Request()->kode_ring,
                'jenis_kelamin' => Request()->jenis_kelamin,
                'status_produksi' => 'Hidup',
            ];
            Produksi::find($id)->update($dataproduksihidup);
        } elseif (Request()->status_produksi == 'Mati') {
            $validate = Request()->validate([
                'keterangan' => 'required',
            ], [
                'keterangan.required' => 'Keterangan Harus di Isi',
            ]);
            $dataproduksimati = [
                'kode_ring' => null,
                'jenis_kelamin' => Request()->jenis_kelamin,
                'status_produksi' => 'Mati',
                'keterangan' => Request()->keterangan,
            ];
            Produksi::find($id)->update($dataproduksimati);
            // return redirect('produksi-mati')->with('update', 'Data Produksi Mati Berhasil ditambahkan');
        }

        //notifications
        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', auth()->user()->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Data Burung diubah',
                'message' => auth()->user()->nama_lengkap . ' mengubah data burung pada penangkaran ' . auth()->user()->penangkaran->lokasi_penangkaran,
            ]);
            event(new NotifUser($notif));
        }
    }
}
