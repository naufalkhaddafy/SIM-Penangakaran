<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Indukan;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Produksi;
use App\Events\NotifUser;
use App\Models\Penangkaran;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $penangkarans = Penangkaran::find($id);
        // $produksis = Produksi::all();
        $produksis = Produksi::with('indukans')->where('status_produksi', 'Indukan')->get();
        // $tes = [];
        // foreach ($allProduksi as $produksi) {
        //     if ($produksi->indukans == null) {
        //         $tes[] = $produksi;
        //     }
        // }
        // return response()->json($tes);

        return view('kandang.modal.create', compact('penangkarans', 'produksis'));
    }
    public function ModalUpdate($id)
    {
        $data = Kandang::with('penangkaran', 'indukans')->find($id);
        $produksis = Produksi::with('indukans')->where('status_produksi', 'Indukan')->get();
        $indukan = $data->indukans;
        foreach ($indukan->where('status', 'Pertama') as $indukanPertama) {
            $indukanPertama = $indukanPertama;
        }
        foreach ($indukan->where('status', 'Kedua') as $indukanKedua) {
            $indukanKedua = $indukanKedua;
        }

        $penangkarans = Penangkaran::all();
        $kategori = [
            'Produktif' => 'Produktif',
            'Tidak Produktif' => 'Tidak Produktif',
            'Ganti Bulu' => 'Ganti Bulu',
        ];
        return view('kandang.modal.update', compact('data', 'penangkarans', 'kategori', 'indukanPertama', 'indukanKedua', 'produksis'));
    }
    public function ModalDelete($id)
    {
        $data = Kandang::find($id);
        $penangkarans = Penangkaran::all();
        return view('kandang.modal.delete', compact('data', 'penangkarans'));
    }
    public function ShowKandang($id)
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::find($id),
            'kandangs' => Kandang::all(),
            'indukans' => Indukan::all(),
            'produksis' => Produksi::all(),
        ];
        return view('kandang.show', $data);
    }
    //create kandang
    public function CreateKandang(Request $request)
    {
        $validatekandang = $request->validate([
            'nama_kandang' => 'required',
            'tgl_masuk_kandang' => 'required',
            'kategori' => 'required',
            'penangkaran_id' => 'required',
            'indukan_pertama' => 'required',
            'indukan_kedua' => 'required|different:indukan_pertama',
        ], [
            'nama_kandang.required' => 'Nama Kandang Harus di Isi',
            'tgl_masuk_kandang.required' => 'Tanggal Masuk Kandang Harus di Isi',
            'kategori.required' => 'Kategori Kandang Harus di Isi',
            'penangkaran_id.required' => 'Kategori Kandang Harus di Isi',
            'indukan_pertama.required' => 'Indukan Pertama Harus di Isi',
            'indukan_kedua.required' => 'Indukan Kedua Harus di Isi',
            'indukan_kedua.different' => 'Indukan Pertama dan Kedua Harus Beda',
        ]);

        $kandang = Kandang::create([
            'nama_kandang' => $request->nama_kandang,
            'tgl_masuk_kandang' => $request->tgl_masuk_kandang,
            'kategori' => $request->kategori,
            'penangkaran_id' => $request->penangkaran_id,
        ]);

        Indukan::create([
            'kandang_id' => $kandang->id,
            'produksi_id' => $request->indukan_pertama,
            'status' => 'Pertama',
        ]);
        Indukan::create([
            'kandang_id' => $kandang->id,
            'produksi_id' => $request->indukan_kedua,
            'status' => 'Kedua',
        ]);

        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', $request->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Menambahkan Kandang',
                'message' => auth()->user()->nama_lengkap . ' Menambahkan Kandang ' . $kandang->nama_kandang,
            ]);
            event(new NotifUser($notif));
        }
    }
    public function UpdateKandang(Request $request, $id)
    {
        $kandang = Kandang::find($id);
        $validatekandang = $request->validate([
            'nama_kandang' => 'required',
            'indukan_pertama' => 'required',
            'indukan_kedua' => 'required|different:indukan_pertama',
            'tgl_masuk_kandang' => 'required',
            'kategori' => 'required',
            'penangkaran_id' => 'required',
        ], [
            'nama_kandang.required' => 'Nama Kandang Harus di Isi',
            'indukan_pertama.required' => 'Indukan Pertama Harus di Isi',
            'indukan_kedua.required' => 'Indukan Kedua Harus di Isi',
            'indukan_kedua.different' => 'Indukan Pertama dan Kedua Harus Beda',
            'tgl_masuk_kandang.required' => 'Tanggal Masuk Kandang Harus di Isi',
            'kategori.required' => 'Kategori Kandang Harus di Isi',
            'penangkaran_id.required' => 'Penangkara Tidak Terdeteksi',
        ]);
        Kandang::find($id)->update($validatekandang);
        $indukan = [
            [
                'produksi_id' => Request()->indukan_pertama,
                'status' => 'Pertama',
            ],
            [
                'produksi_id' => Request()->indukan_kedua,
                'status' => 'Kedua',
            ]
        ];

        Indukan::where('kandang_id', $id)->where('status', 'Pertama')->update($indukan[0]);
        Indukan::where('kandang_id', $id)->where('status', 'Kedua')->update($indukan[1]);
        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', $request->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Mengubah Kandang',
                'message' => auth()->user()->nama_lengkap . ' Mengubah Kandang ' . $kandang->nama_kandang,
            ]);
            event(new NotifUser($notif));
        }
    }
    //delete kandang
    public function DeleteKandang($id)
    {
        $kandang = Kandang::find($id);
        Kandang::find($id)->forceDelete();
        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', $kandang->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Menghapus Kandang',
                'message' => auth()->user()->nama_lengkap . ' Menghapus Kandang ' . $kandang->nama_kandang,
            ]);
            event(new NotifUser($notif));
        }
        // return redirect()->back()->with('delete','Berhasil menghapus data kandang');
    }

    public function RiwayatKandang($id)
    {
        $kandang = Kandang::with('produksis', 'kebersihans')->get();
        $kandangs = $kandang->find($id);
        $produksis = $kandangs->produksis;
        $kebersihans = $kandangs->kebersihans;
        return view('kandang.riwayatkandang', compact('kandangs', 'produksis', 'kebersihans'));
    }
}
