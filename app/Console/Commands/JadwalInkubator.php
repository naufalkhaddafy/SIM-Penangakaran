<?php

namespace App\Console\Commands;

use App\Models\Produksi;
use Illuminate\Console\Command;

class JadwalInkubator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:inkubator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Data Inkubator';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get relation produksis table
        $allProduksi = Produksi::all()->load('kandang', 'jadwal');
        //get all produksi not null by kandang data
        $NotNullProduksi = [];
        foreach ($allProduksi->where('status_produksi', 'Inkubator') as $produksi) {
            if ($produksi->kandang !== null) {
                $NotNullProduksi[] = $produksi;
            }
        }
        //collect data last produksi based on kandang
        // $LastProduksiByKandang = collect($NotNullProduksi)->groupBy('kandang_id')->map(function ($item) {
        //     return $item->all();
        // });
        //get value jadwal from relation produksi
        $JadwalProduksi = collect($NotNullProduksi)->map(function ($item) {
            return $item->jadwal;
        });
        //Update kategori kandang berdasarkan tanggal
        $UpdateKandang = $JadwalProduksi->map(function ($item) {
            if ($item->tgl_akan_menetas_end < date('Y-m-d')) {
                //get id kandang from $item
                $item->produksi->status_produksi = 'Mati';
                $item->produksi->keterangan = 'Update Mati Inkubator Otomatis';
                $item->produksi->save();
                // return 'Success Get Function';
            } else {
                // must give a notifikasi
                // return 'Tidak Update';
            }
            return $item;
        });
    }
}
