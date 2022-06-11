<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kandang;
use App\Models\Panduan;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class PekerjaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ReadPanduan()
    {
        $data = [
            'panduans' => Panduan::all(),
        ];
        return view('u_panduan', $data);
    }
    public function DetailKandang()
    {
        $data = ([
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
            'users' => User::all(),
        ]);
        return view('u_kandang', $data);
    }
}
