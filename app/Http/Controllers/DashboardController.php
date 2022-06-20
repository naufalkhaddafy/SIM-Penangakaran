<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Jadwal;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\Kebersihan;
use App\Models\Penangkaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //halaman dashboard
    public function ReadDashboard()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
            'jadwals' => Jadwal::all(),
            'produksis' => Produksi::all(),
            'kebersihan' => Kebersihan::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];
        $produktif = auth()->user()->penangkaran->kandangs ?? [];

        return view('dashboard.dashboard', $data, compact('produktif'));
    }
    public function ReadDashboardJadwal()
    {
        $data = [
            'jadwals' => Jadwal::all(),
            'produksis' => Produksi::all(),
            'kebersihan' => Kebersihan::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];
        $produktif = auth()->user()->penangkaran->kandangs ?? [];

        return view('dashboard.data.jadwal', $data, compact('produktif'));
    }
    public function ReadDashboardPakan()
    {
        $data = [
            'jadwals' => Jadwal::all(),
            'produksis' => Produksi::all(),
            'kebersihan' => Kebersihan::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];
        return view('dashboard.data.pakan', $data);
    }
    public function ReadDashboardKebersihan()
    {
        $data = [
            'jadwals' => Jadwal::all(),
            'produksis' => Produksi::all(),
            'kebersihan' => Kebersihan::all(),
            date_default_timezone_set('Asia/Jakarta')
        ];
        return view('dashboard.data.kebersihan', $data);
    }
}
