<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    //middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Data Pakan tabel
    public function ShowPakan()
    {
        $data = [
            'pakans' => Pakan::all(),
        ];
        return view('pakan.show', $data);
    }
    public function ModalCreate()
    {
        $penangkarans =  Penangkaran::all();
        return view('pakan.modal.create', compact('penangkarans'));
    }
    public function ModalDelete($id)
    {
        $data =  Pakan::find($id);
        return view('pakan.modal.delete', compact('data'));
    }
    //create pakan
    public function CreatePakan()
    {
        $validatepakan = Request()->validate(
            [
                'penangkaran_id' => 'required',
                'kode_tempat' => 'required',
                'nama_pakan' => 'required',
                'tgl_kadaluwarsa' => 'required',
                'status' => 'required',

            ],
            [
                'penangkaran_id.required' => 'Penangkaran tidak boleh kosong',
                'kode_tempat.required' => 'kode Harus di Isi',
                'nama_pakan.required' => 'Nama Pakan Harus diisi',
                'tgl_kadaluwarsa.required' => 'Tanggal Kadaluwarsa Harus diisi',
                'status.required' => 'Status Harus diisi',
            ]
        );
        Pakan::create($validatepakan);
        // return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }
    public function DeletePakan($id)
    {
        Pakan::find($id)->delete();
        // return redirect()->back()->with('delete', 'Berhasil Menghapus Data Pakan');
    }
}
