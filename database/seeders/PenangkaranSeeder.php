<?php

namespace Database\Seeders;

use App\Models\Penangkaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenangkaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $PNK = [
            [
                'kode_penangkaran' => 'PNK-01',
                'lokasi_penangkaran' => 'Kalimantan',
            ],
            [
                'kode_penangkaran' => 'PNK-02',
                'lokasi_penangkaran' => 'Jawa',
            ],
            [
                'kode_penangkaran' => 'PNK-03',
                'lokasi_penangkaran' => 'Sumatra',
            ],
        ];
        foreach ($PNK as $data) {
            Penangkaran::create($data);
        }
    }
}
