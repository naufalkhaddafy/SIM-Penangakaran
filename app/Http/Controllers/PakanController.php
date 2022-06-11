<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PakanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //create pakan
    public function CreatePakan()
    {
        $validatepakan = Request()->validate(
            [
                'kode_tempat' => 'required',
                'nama_pakan' => 'required',
                'expired' => 'required',
                //'tgl_kadaluwarsa' =>'required',
                // 'kategori' =>'required|unique:categories',

            ],
            [
                'kode_tempat.required' => 'kode Harus di Isi',
                'nama_pakan.required' => 'Harus diisi',
                'expired.required' => 'Harus diisi',
            ]
        );
        Pakan::insert($validatepakan);
        return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }
    public function DeletePakan($id)
    {
        Pakan::find($id)->delete();
        return redirect()->back()->with('delete', 'Berhasil Menghapus Data Pakan');
    }
}
