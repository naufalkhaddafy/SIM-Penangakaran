<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // viewpenangkaran
    public function ReadPenangkaran()
    {
        $data = [
            'penangkarans' => Penangkaran::all(),
        ];
        return view('penangkaran.penangkaran', $data);
    }
    //view kandang
    public function ReadKandang()
    {
        $data = ([
            'kandangs' => Kandang::all(),
            'penangkarans' => Penangkaran::all(),
            'users' => User::all(),
        ]);
        return view('kandang', $data);
    }

    public function ReadUserPemilik()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.pemilik', $data);
    }
    public function ReadUserPekerja()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.pekerja', $data);
    }
    public function ReadPakan()
    {
        $data = ([
            'pakans' => Pakan::all(),
        ]);
        return view('pakan', $data);
    }
    public function ReadPanduan()
    {

        return view('panduan.panduan');
    }
}
