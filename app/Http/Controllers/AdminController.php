<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    //halaman dashboard
    public function index()
    {
        return view('dashboard');
    }
    public function user()
    {
        return view('welcome');
    }
}
