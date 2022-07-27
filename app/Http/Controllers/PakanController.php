<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pakan;
use App\Events\NotifUser;
use App\Models\Penangkaran;
use App\Models\Notification;
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
    public function ModalUpdate($id)
    {
        $pakans =  Pakan::find($id);
        $status = [
            'Baru' => 'Baru',
            'Setengah' => 'Setengah',
            'Habis' => 'Habis',
            'Kadaluwarsa' => 'Kadaluwarsa',
        ];
        return view('pakan.modal.update', compact('pakans', 'status'));
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
                'kode_tempat.required' => 'Kode Harus di Isi',
                'nama_pakan.required' => 'Nama Pakan Harus diisi',
                'tgl_kadaluwarsa.required' => 'Tanggal Kadaluwarsa Harus diisi',
                'status.required' => 'Status Harus diisi',
            ]
        );
        Pakan::create($validatepakan);
        //notif
        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', Request()->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Menambah Pakan',
                'message' => auth()->user()->nama_lengkap . ' Menambahkan Pakan ' . Request()->nama_pakan,
            ]);
            event(new NotifUser($notif));
        }
        // return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }
    //update pakan
    public function UpdatePakan($id)
    {
        $pakan = Pakan::find($id);
        $validate = Request()->validate(
            [
                'status' => 'required',
            ],
            [
                'status.required' => 'Status Harus diisi',
            ]
        );
        Pakan::find($id)->update([
            'status' => $validate['status'],
        ]);
        //notif
        $users = User::where('role', 'pemilik')->orWhere('penangkaran_id', $pakan->penangkaran_id)->get();
        foreach ($users as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Mengubah Pakan',
                'message' => auth()->user()->nama_lengkap . ' Mengubah Status Pakan ' . $pakan->nama_pakan,
            ]);
            event(new NotifUser($notif));
        }
    }
    public function DeletePakan($id)
    {
        $pakan = Pakan::find($id);
        Pakan::find($id)->delete();
        $pemiliks = User::where('role', 'pemilik')->orWhere('penangkaran_id', $pakan->penangkaran_id)->get();
        foreach ($pemiliks as $user) {
            $notif = Notification::create([
                'user_id' => $user->id,
                'type' => 'Menambah Pakan',
                'message' => auth()->user()->nama_lengkap . ' Menghapus Pakan ' . $pakan->nama_pakan,
            ]);
            event(new NotifUser($notif));
        }
        // return redirect()->back()->with('delete', 'Berhasil Menghapus Data Pakan');
    }
}
