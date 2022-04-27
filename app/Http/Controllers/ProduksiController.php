<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
use App\Models\Penangkaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ProduksiInkubator(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);


        return view('produksi.inkubator',$data);
    }
    public function ProduksiHidup(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),

        ]);

        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('produksi.hidup',$data,compact('tgl_today'));
    }
    public function ProduksiMati(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi.mati',$data);
    }
    public function CreateProduksiTelur($id)
    {

        $validateproduksi = Request()->validate([
                'kandang_id' =>'required',
                'tgl_bertelur' =>'required',
                'status_telur' =>'required',
                'tgl_masuk_inkubator' =>'required',
            ],[
                'kandang_id.required' => 'Harus di Isi',
                'tgl_bertelur.required' => 'Harus di Isi',
                'status_telur.required' => 'Harus di Isi',
                'tgl_masuk_inkubator.required' => 'Harus di Isi',
            ]);
        Produksi::create($validateproduksi);

        $lastproduksi=Produksi::where('kandang_id', $id)->latest()->first();
        if($lastproduksi->status_telur =='pertama')
        {
            $tgl_akan_bertelur_start=date('Y-m-d', strtotime('+1 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_bertelur_end=date('Y-m-d', strtotime('+2 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_start=date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_end=date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));


        }elseif($lastproduksi->status_telur == 'kedua')
        {
            $tgl_akan_bertelur_start=date('Y-m-d', strtotime('+10 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_bertelur_end=date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_start=date('Y-m-d', strtotime('+13 days', strtotime($lastproduksi->tgl_bertelur)));
            $tgl_akan_menetas_end=date('Y-m-d', strtotime('+14 days', strtotime($lastproduksi->tgl_bertelur)));

        }else{
            abort(404);
        }
        $tambahjadwal = [
                'produksi_id' => $lastproduksi->id,
                'tgl_akan_bertelur_start' => $tgl_akan_bertelur_start,
                'tgl_akan_bertelur_end' => $tgl_akan_bertelur_end,
                'tgl_akan_menetas_start' =>$tgl_akan_menetas_start,
                'tgl_akan_menetas_end' =>$tgl_akan_menetas_end,
                'kode_tempat_inkubator' =>Request()->kode_tempat_inkubator,
        ];
        Jadwal::create($tambahjadwal);
        return redirect('produksi-inkubator')->with('create','Berhasil Menambahkan Produksi Telur');
    }
    public function UpdateProduksiInkubator($id){
        $dataproduksiinkubator= [
            'tgl_menetas' =>Request()->tgl_menetas,
            'status_produksi' =>'Hidup',
        ];
        Produksi::find($id)->update($dataproduksiinkubator);
        return redirect('produksi-hidup')->with('update','Data Telur Hidup Berhasil di update');
    }
    public function UpdateProduksiHidup($id){
        $statusproduksi = [
            'status_produksi' =>Request()->status_produksi,
        ];


        if ($statusproduksi['status_produksi']=='Hidup'){
            $dataproduksihidup= [
                'kode_ring' =>Request()->kode_ring,
                'jenis_kelamin' =>Request()->jenis_kelamin,
                'status_produksi' =>'Hidup',
            ];
            Produksi::find($id)->update($dataproduksihidup);
            return redirect('produksi-hidup')->with('update','Data Produksi Berhasil di update');
        } elseif($statusproduksi['status_produksi']=='Mati'){

            $dataproduksimati =[
                'kode_ring' =>Request()->kode_ring,
                'jenis_kelamin' =>Request()->jenis_kelamin,
                'status_produksi' => 'Mati',
                'keterangan' =>Request()->keterangan,
            ];
            Produksi::find($id)->update($dataproduksimati);
            return redirect('produksi-mati')->with('update','Data Produksi Mati Berhasil ditambahkan');
        }

    }
}
