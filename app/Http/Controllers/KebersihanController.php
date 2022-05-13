<?php

namespace App\Http\Controllers;

use App\Models\Kebersihan;
use App\Models\Produksi;
use Illuminate\Http\Request;

class KebersihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateKebersihan()
    {
        $datakebersihan=[
            'kandang_id' =>Request()->kandang_id,
            'tgl_pembersihan' =>Request()->tgl_pembersihan,
            $jadwal_pembersihan=date('Y-m-d', strtotime('+2 days', strtotime(Request()->tgl_pembersihan))),
            'jadwal_pembersihan' =>$jadwal_pembersihan,
        ];
        Kebersihan::Create($datakebersihan);
        return redirect('dashboard')->with('create','Data Kandang Dibersihkan telah direkap');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}