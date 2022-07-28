<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Produksi;
use App\Events\NotifUser;
use App\Models\Notification;
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
                $item->produksi->keterangan = 'Update Otomatis Tidak Menetas';
                $item->produksi->save();
                // return 'Success Get Function';
                $penangkaran = $item->produksi->kandang->penangkaran->id;
                $users = User::where('role', 'pemilik')->orWhere('penangkaran_id', $penangkaran)->get();
                foreach ($users as $user) {
                    $notif = Notification::create([
                        'user_id' => $user->id,
                        'type' => 'Update Telur Mati',
                        'message' => 'Update, telur pada Inkubator ' . $item->kode_tempat_inkubator . ' di penangkaran ' . $item->produksi->kandang->penangkaran->lokasi_penangkaran . ' tidak menetas/mati ',
                    ]);
                    event(new NotifUser($notif));
                }
            } elseif (date('Y-m-d') >= $item->tgl_akan_menetas_start && date('Y-m-d') <= $item->tgl_akan_menetas_end) {
                // give a notification masuk jadwal menetas
                $penangkaran = $item->produksi->kandang->penangkaran->id;
                $users = User::where('role', 'pemilik')->orWhere('penangkaran_id', $penangkaran)->get();
                foreach ($users as $user) {
                    $notif = Notification::create([
                        'user_id' => $user->id,
                        'type' => 'Jadwal Menetas',
                        'message' => 'Hari ini, telur pada tempat Inkubator ' . $item->kode_tempat_inkubator . ' di penangkaran ' . $item->produksi->kandang->penangkaran->lokasi_penangkaran . ' akan menetas ',
                    ]);
                    event(new NotifUser($notif));
                }
            }
            return $item;
        });
    }
}
