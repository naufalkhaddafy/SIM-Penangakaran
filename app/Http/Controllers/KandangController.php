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
        $produksis = Produksi::all();

        return view('kandang.modal.create', compact('penangkarans', 'produksis'));
    }
    public function ModalUpdate($id)
    {
        $data = Kandang::find($id);
        $penangkarans = Penangkaran::all();
        $kategori = [
            'Produktif' => 'Produktif',
            'Tidak Produktif' => 'Tidak Produktif',
            'Ganti Bulu' => 'Ganti Bulu',
        ];
        return view('kandang.modal.update', compact('data', 'penangkarans', 'kategori'));
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
    public function CreateKandang()
    {
        $validatekandang = Request()->validate([
            'nama_kandang' => 'required',
            'tgl_masuk_kandang' => 'required',
            'kategori' => 'required',
            'penangkaran_id' => 'required',
        ], [
            'nama_kandang.required' => 'Nama Kandang Harus di Isi',
            'tgl_masuk_kandang.required' => 'Tanggal Masuk Kandang Harus di Isi',
            'kategori.required' => 'Kategori Kandang Harus di Isi',
            'penangkaran_id.required' => 'Kategori Kandang Harus di Isi',
        ]);
        $rules = [
            'produksi_id' => 'required|unique:indukans,produksi_id',
        ];
        $input1 = [
            'produksi_id' => Request()->indukan_pertama,
        ];
        $pesan1 = [
            'required' => 'Indukan Pertama Harus di isi',
            'unique' => 'Indukan Pertama Sudah Ada',
        ];
        $input2 = [
            'produksi_id' => Request()->indukan_kedua,
        ];
        $pesan2 = [
            'required' => 'Indukan Kedua Harus di isi',
            'unique' => 'Indukan Kedua Sudah Ada',
        ];
        Validator::make($input1, $rules, $pesan1)->validate();
        Validator::make($input2, $rules, $pesan2)->validate();
        Kandang::create($validatekandang);
        $lastkandang = Kandang::get()->last();
        $indukan = [
            [
                'kandang_id' => $lastkandang->id,
                'produksi_id' => Request()->indukan_pertama,
                'status' => 'Pertama',
            ],
            [
                'kandang_id' => $lastkandang->id,
                'produksi_id' => Request()->indukan_kedua,
                'status' => 'Kedua',
            ]
        ];
        foreach ($indukan as $data) {
            Indukan::create($data);
        }
        // Indukan::create();
        // Validator::make([
        //     'nama_kandang' => Request()->nama_kandang,
        //     'tgl_masuk_kandang' => Request()->tgl_masuk_kandang,
        //     'kategori' => Request()->kategori,
        //     'penangkaran_id' => Request()->penangkaran_id,
        //     'produksi_id' => Request()->indukan_pertama,
        // ], [
        //     'nama_kandang' => 'required',
        //     'tgl_masuk_kandang' => 'required',
        //     'kategori' => 'required',
        //     'penangkaran_id' => 'required',
        //     'produksi_id' => 'required|unique:indukans',
        //     'produksi_id' => 'required|unique:indukans',
        // ], [
        //     'nama_kandang.required' => 'Nama Kandang Harus di Isi',
        //     'tgl_masuk_kandang.required' => 'Tanggal Masuk Kandang Harus di Isi',
        //     'kategori.required' => 'Kategori Kandang Harus di Isi',
        //     'penangkaran_id.required' => 'Penangkaran tidak terdeteksi',
        //     'produksi_id.required' => 'Indukan Harus di Isi',
        //     'produksi_id.unique' => 'Indukan Sudah Ada',
        // ])->validate();
    }
    public function UpdateKandang($id)
    {
        $validatekandang = Request()->validate([
            'nama_kandang' => 'required',
            'kategori' => 'required',
            'penangkaran_id' => 'required'
        ], [
            'nama_kandang.required' => 'Nama Kandang Harus di Isi',
            'kategori.required' => 'Kategori Kandang Harus di Isi',
        ]);
        Kandang::find($id)->update($validatekandang);
    }
    //delete kandang
    public function DeleteKandang($id)
    {
        Kandang::find($id)->forceDelete();

        // return redirect()->back()->with('delete','Berhasil menghapus data kandang');
    }

    public function RiwayatKandang($id)
    {
        $data = ([
            'kandangs' => Kandang::find($id),
        ]);
        return view('kandang.riwayatkandang', $data);
    }
}
