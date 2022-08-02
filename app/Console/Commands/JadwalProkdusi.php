<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Produksi;
use App\Events\NotifUser;
use App\Models\Notification;
use Illuminate\Console\Command;

class JadwalProkdusi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:produksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Jadwal Produksi';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get relation produksis table
        $allProduksi = Produksi::with('kandang', 'jadwal')->get();
        //get all produksi not null by kandang data
        $NotNullProduksi = [];
        foreach ($allProduksi as $produksi) {
            if ($produksi->kandang !== null && $produksi->kandang->kategori == 'Produktif') {
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

            $today = date('Y-m-d');
            if ($item->tgl_akan_bertelur_end < $today) {
                $item->produksi->kandang->kategori = 'Ganti Bulu';
                $item->produksi->kandang->save();
                // return 'Success Get Function';
                $penangkaran = $item->produksi->kandang->penangkaran->id;
                $users = User::where('role', 'pemilik')->orWhere('penangkaran_id', $penangkaran)->get();
                foreach ($users as $user) {
                    $notif = Notification::create([
                        'user_id' => $user->id,
                        'type' => 'Update Status Kandang',
                        'message' => 'Hari ini, kandang ' . $item->produksi->kandang->nama_kandang . ' di penangkaran ' . $item->produksi->kandang->penangkaran->lokasi_penangkaran . ' berubah status menjadi Ganti Bulu',
                    ]);
                    event(new NotifUser($notif));
                }
            } elseif ($today >= $item->tgl_akan_bertelur_start && $today <= $item->tgl_akan_bertelur_end) {
                # must give a notifikasi
                $penangkaran = $item->produksi->kandang->penangkaran->id;
                $users = User::where('role', 'pemilik')->orWhere('penangkaran_id', $penangkaran)->get();
                foreach ($users as $user) {
                    $notif = Notification::create([
                        'user_id' => $user->id,
                        'type' => 'Jadwal Bertelur',
                        'message' => 'Hari ini, kandang ' . $item->produksi->kandang->nama_kandang . ' di penangkaran ' . $item->produksi->kandang->penangkaran->lokasi_penangkaran . ' akan bertelur ',
                    ]);
                    event(new NotifUser($notif));
                }
            }
            return $item;
        });
    }
}
