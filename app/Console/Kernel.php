<?php

namespace App\Console;

use App\Models\Jadwal;
use App\Models\Produksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            //get relation produksis table
            $allProduksi = Produksi::all()->load('kandang', 'jadwal');
            //get all produksi not null by kandang data
            $NotNullProduksi = [];
            foreach ($allProduksi as $produksi) {
                if ($produksi->kandang !== null) {
                    $NotNullProduksi[] = $produksi;
                }
            }
            // collect data last produksi based on kandang
            $LastProduksiByKandang = collect($NotNullProduksi)->groupBy('kandang_id')->map(function ($item) {
                return $item->last();
            });
            //get value jadwal from
            $JadwalProduksi = $LastProduksiByKandang->map(function ($item) {
                return $item->jadwal;
            });
            //Update kategori kandang berdasarkan tanggal
            $UpdateKandang = $JadwalProduksi->map(function ($item) {
                if ($item->tgl_akan_bertelur_end < date('Y-m-d')) {
                    //get id kandang from $item
                    $item->produksi->kandang->kategori = 'Ganti Bulu';
                    $item->produksi->kandang->save();
                    // return 'Success Get Function';
                } else {
                    // must give a notifikasi
                    // return 'Tidak Update';
                }
                return $item;
            });
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
