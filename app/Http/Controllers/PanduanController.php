<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Panduan;
use App\Events\NotifUser;
use App\Models\Notification;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowPanduan()
    {
        $data = [
            'panduans' => Panduan::all(),
        ];
        return view('panduan.show', $data);
    }
    public function ModalCreate()
    {
        return view('panduan.modal.create');
    }
    public function ModalRead($id)
    {
        $data = Panduan::find($id);
        return view('panduan.modal.read', compact('data'));
    }
    public function ModalUpdate($id)
    {
        $data = Panduan::find($id);
        $kategori = [
            'Reproduksi' => 'Reproduksi',
            'Perkandangan' => 'Perkandangan',
            'Pakan' => 'Pakan',
            'Perawatan' => 'Perawatan',
        ];
        $status = [
            'publish' => 'publish',
            'draft' => 'draft',
        ];
        return view('panduan.modal.update', compact('data', 'status', 'kategori'));
    }
    public function ModalDelete($id)
    {
        $data = Panduan::find($id);
        return view('panduan.modal.delete', compact('data'));
    }

    public function CreatePanduan()
    {
        $validatepanduan = Request()->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'status' => 'required',
        ], [
            'user_id.required' => 'User Tidak terdeteksi',
            'judul.required' => 'Judul Harus di Isi',
            'isi.required' => 'Isi Panduan Harus di Isi',
            'kategori.required' => 'Kategori Harus di Isi',
            'status.required' => 'Status Harus di Isi',
        ]);
        $panduan = Panduan::create($validatepanduan);

        if (Request()->status == 'publish') {
            $users = User::all();
            foreach ($users as $user) {
                $notif = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'Paduan Baru',
                    'message' => auth()->user()->nama_lengkap . ' Menambahkan Panduan ' . Request()->kategori,
                ]);
                event(new NotifUser($notif));
            }
        }
    }
    public function UpdatePanduan($id)
    {
        $validatepanduan = Request()->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'status' => 'required',
        ], [
            'user_id.required' => 'User Tidak terdeteksi',
            'judul.required' => 'Judul Harus di Isi',
            'isi.required' => 'Isi Panduan Harus di Isi',
            'kategori.required' => 'Kategori Harus di Isi',
            'status.required' => 'Status Harus di Isi',
        ]);
        Panduan::find($id)->update($validatepanduan);

        if (Request()->status == 'publish') {
            $users = User::all();
            foreach ($users as $user) {
                $notif = Notification::create([
                    'user_id' => $user->id,
                    'type' => 'Paduan diubah',
                    'message' => auth()->user()->nama_lengkap . ' Mengubah Panduan ' . Request()->kategori,
                ]);
                event(new NotifUser($notif));
            }
        }
    }
    public function DeletePanduan($id)
    {
        Panduan::find($id)->delete();
    }
}
