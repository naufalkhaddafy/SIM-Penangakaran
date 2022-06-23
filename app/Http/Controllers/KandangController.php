<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Indukan;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Produksi;
use App\Models\Penangkaran;
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
    // public function CreateKandang()
    // {
    //     // $validatekandang = Request()->validate([
    //     //     'nama_kandang' => 'required',
    //     //     'tgl_masuk_kandang' => 'required',
    //     //     'kategori' => 'required',
    //     //     'penangkaran_id' => 'required',
    //     // ], [
    //     //     'nama_kandang.required' => 'Nama Kandang Harus di Isi',
    //     //     'tgl_masuk_kandang.required' => 'Tanggal Masuk Kandang Harus di Isi',
    //     //     'kategori.required' => 'Kategori Kandang Harus di Isi',
    //     //     'penangkaran_id.required' => 'Kategori Kandang Harus di Isi',
    //     // ]);
    //     $rules = [
    //         'nama_kandang' => 'required',
    //         'tgl_masuk_kandang' => 'required',
    //         'kategori' => 'required',
    //         'penangkaran_id' => 'required',
    //         'produksi_id' => 'required|unique:indukans',
    //     ];
    //     $input1 = [
    //         'nama_kandang' => Request()->nama_kandang,
    //         'tgl_masuk_kandang' => Request()->tgl_masuk_kandang,
    //         'kategori' => Request()->kategori,
    //         'penangkaran_id' => Request()->penangkaran_id,
    //         'produksi_id' => Request()->indukan_pertama,
    //         'produksi_id' => Request()->indukan_kedua,
    //     ];
    //     $pesan1 = [
    //         'nama_kandang.required' => 'Nama Kandang Harus di Isi',
    //         'tgl_masuk_kandang.required' => 'Tanggal Masuk Kandang Harus di Isi',
    //         'kategori.required' => 'Kategori Kandang Harus di Isi',
    //         'penangkaran_id.required' => 'Penangkaran Tidak Terdeteksi',
    //         'produksi_id.required' => 'Indukan Pertama dan Kedua Harus di isi',
    //         'produksi_id.unique' => 'Indukan Sudah Ada',
    //     ];
    //     // $input2 = [
    //     //     'produksi_id' => Request()->indukan_kedua,
    //     // ];
    //     // $pesan2 = [
    //     //     'required' => 'Indukan Kedua Harus di isi',
    //     //     'unique' => 'Indukan Kedua Sudah Ada',
    //     // ];
    //     $validatekandang = Validator::make($input1, $rules, $pesan1)->validate();
    //     // Validator::make($input2, $rules, $pesan2)->validate();
    //     if (Request()->indukan_pertama == Request()->indukan_kedua) {
    //         return response()->json(array('error' => 'salah'));
    //         exit;
    //     } else {
    //     }
    //     Kandang::create($validatekandang);
    //     $lastkandang = Kandang::get()->last();
    //     $indukan = [
    //         [
    //             'kandang_id' => $lastkandang->id,
    //             'produksi_id' => Request()->indukan_pertama,
    //             'status' => 'Pertama',
    //         ],
    //         [
    //             'kandang_id' => $lastkandang->id,
    //             'produksi_id' => Request()->indukan_kedua,
    //             'status' => 'Kedua',
    //         ]
    //     ];
    //     foreach ($indukan as $data) {
    //         Indukan::create($data);
    //     }
    // }
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
    }
    public function UpdateKandang(Request $request, $id)
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
            'penangkaran_id.required' => 'Penangkara Tidak Terdeteksi',
            'indukan_pertama.required' => 'Indukan Pertama Harus di Isi',
            'indukan_kedua.required' => 'Indukan Kedua Harus di Isi',
            'indukan_kedua.different' => 'Indukan Pertama dan Kedua Harus Beda',
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
    }
    //delete kandang
    public function DeleteKandang($id)
    {
        Kandang::find($id)->forceDelete();

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
