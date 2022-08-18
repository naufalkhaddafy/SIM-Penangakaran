<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kandang;
use App\Models\Penangkaran;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    public function ModalRead($id)
    {
        $data = User::find($id);
        return view('pengguna.modal.read', compact('data'));
    }
    public function ModalCreate()
    {
        $penangkaran = Penangkaran::all();
        return view('pengguna.modal.create', compact('penangkaran'));
    }
    public function ModalUpdate($id)
    {
        $data = User::find($id);
        $penangkarans = Penangkaran::all();
        $role = [
            'Pemilik' => 'pemilik',
            'Pekerja' => 'pekerja',
        ];
        $pw = Hash::check($data->password, $data->password);
        return view('pengguna.modal.update', compact('data', 'penangkarans', 'role', 'pw'));
    }
    public function ModalDelete($id)
    {
        $data = User::find($id);
        $penangkarans = Penangkaran::all();
        return view('pengguna.modal.delete', compact('data', 'penangkarans'));
    }
    public function ReadTablePemilik()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.tablepemilik', $data);
    }
    public function ReadTablePekerja()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.tablepekerja', $data);
    }

    // nambah user
    public function CreateUser(Request $request)
    {
        $validateuser = $request->validate([
            'nama_lengkap' => 'required|min:5|max:30',
            'username' => 'required|unique:users|min:5|max:10',
            'nohp' => 'required|unique:users|min:2|max:14',
            'password' => 'required|min:5',
            'role' => 'required',
            'penangkaran_id' => 'nullable',
        ], [
            'nama_lengkap.required' => 'Nama Harus di Isi',
            'nama_lengkap.min' => 'Nama 5 digit',
            'nama_lengkap.max' => 'Nama 30 digit',
            'username.required' => 'Username Harus di Isi',
            'username.unique' => 'Username telah terdaftar',
            'username.min' => 'Username minimal 5 digit',
            'username.max' => 'Username 10 digit',
            'role.required' => 'Role Harus di isi',
            'nohp.required' => 'No. Hp Harus di Isi',
            'nohp.unique' => 'No. Hp telah terdaftar',
            'nohp.min' => 'Masukan No. Hp minimal 2 digit',
            'nohp.max' => 'Masukan No. Hp maksimal 14 digit',
            'password.required' => 'Password harus di Isi',
            'password.min' => 'Password minimal 5 Digit',
            'penangkaran_id.required' => 'Harus diisi',
        ]);

        $validateuser['password'] = Hash::make($validateuser['password']);
        User::create($validateuser);
        // return redirect()->back()->with('create','Berhasil menambahkan pengguna');
    }
    // hapus pengguna
    public function DeleteUser($id)
    {
        User::find($id)->delete();
        // return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }

    //update
    public function UpdateUser($id)
    {
        $nohp = User::find($id)->nohp;
        if ($nohp == Request()->nohp) {
            $validateuser = Request()->validate([
                'nama_lengkap' => 'required|min:5|max:30',
                'role' => 'required',
                'penangkaran_id' => 'nullable',
                'password' => 'nullable|min:5',
            ], [
                'nama_lengkap.required' => 'Nama Harus di Isi',
                'nama_lengkap.min' => 'Nama min 5 digit',
                'nama_lengkap.max' => 'Nama max 30 digit',
                'password.min' => 'Passoword min 5 digit',
                'role.required' => 'Role Harus di Isi',
            ]);
        } else {
            $validateuser = Request()->validate([
                'nama_lengkap' => 'required|min:5|max:30',
                'role' => 'required',
                'penangkaran_id' => 'nullable',
                'nohp' => 'required|unique:users|min:2|max:14',
                'password' => 'nullable|min:5',
            ], [
                'nama_lengkap.required' => 'Nama Harus di Isi',
                'nama_lengkap.min' => 'Nama min 5 digit',
                'nama_lengkap.max' => 'Nama max 30 digit',
                'role.required' => 'Role Harus di Isi',
                'nohp.required' => 'No. Hp Harus di Isi',
                'nohp.unique' => 'No. Hp telah terdaftar',
                'nohp.min' => 'Masukan No. Hp minimal 2 digit',
                'nohp.max' => 'Masukan No. Hp maksimal 14 digit',
                'password.min' => 'Passoword min 5 digit',
            ]);
        }
        if (Request()->password != null) {
            $validateuser['password'] = Hash::make(Request()->password);
        } else {
            $validateuser['password'] = User::find($id)->password;
        }
        User::find($id)->update($validateuser);
        // return redirect()->back()->with('toast_success', 'Login Berhasil');
    }

    public function getNotification()
    {
        $notif = auth()->user()->notifications;
        return view('admin-lte.notif.notif', compact('notif'));
    }
    public function readNotification($id)
    {
        $notifcek = Notification::find($id);
        $notifcek->read_at = now();
        $notifcek->save();
        return view('admin-lte.notif.read', compact('notifcek'));
    }
    public function readAllNotification()
    {
        $allNotif = auth()->user()->notifications->sortByDesc('created_at');
        foreach ($allNotif as $notif) {
            $notif->read_at = now();
            $notif->save();
        }
        // return response()->json($allNotif);
        return view('admin-lte.notif.read_all', compact('allNotif'));
    }
    // update pengguna pekerja
    public function ReadProfile($id)
    {
        $data = User::find($id);

        return view('u_profil', compact('data'));
    }
    public function UpdateProfile($id)
    {
        $nohp = User::find($id)->nohp;
        if ($nohp == Request()->nohp) {
            $validate = Request()->validate([
                'nama_lengkap' => 'required|min:5|max:30',
                'password' => 'nullable|min:5|confirmed',
            ], [
                'nama_lengkap.required' => 'Nama Harus di Isi',
                'nama_lengkap.min' => 'Nama 5 digit',
                'nama_lengkap.max' => 'Nama 30 digit',
                'password.min' => 'Passoword min 5 digit',
                'password.confirmed' => 'Password dan Konfirmasi Password tidak sama',

            ]);
        } else {
            $validate = Request()->validate([
                'nama_lengkap' => 'required|min:5|max:30',
                'nohp' => 'required|unique:users|min:2|max:14',
            ], [
                'nama_lengkap.required' => 'Nama Harus di Isi',
                'nama_lengkap.min' => 'Nama 5 digit',
                'nama_lengkap.max' => 'Nama 30 digit',
                'nohp.required' => 'No. Hp Harus di Isi',
                'nohp.unique' => 'No. Hp telah terdaftar',
                'nohp.min' => 'Masukan No. Hp minimal 2 digit',
                'nohp.max' => 'Masukan No. Hp maksimal 14 digit',
            ]);
        }
        if (Request()->password != null) {
            $validate['password'] = Hash::make(Request()->password);
        } else {
            $validate['password'] = User::find($id)->password;
        }
        User::find($id)->update($validate);
        return redirect()->back()->with('toast_success', 'Berhasil Mengubah Data');
    }
}
