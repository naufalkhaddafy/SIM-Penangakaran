<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PNK = [
            [
                'nama_lengkap' => 'admin',
                'username' => 'admin',
                'nohp' => '001',
                'password' => Hash::make('admin'),
                'role' => 'pemilik',
                'penangkaran_id' => null,
            ],
            [
                'nama_lengkap' => 'Muhammad Naufal Khaddafy',
                'username' => 'naufal',
                'nohp' => '1',
                'password' => Hash::make('naufal'),
                'role' => 'pekerja',
                'penangkaran_id' => 1,
            ],
            [
                'nama_lengkap' => 'sarah',
                'username' => 'sarah',
                'nohp' => '2',
                'password' => Hash::make('sarah'),
                'role' => 'pekerja',
                'penangkaran_id' => 2,
            ],
            [
                'nama_lengkap' => 'ririn',
                'username' => 'ririn',
                'nohp' => '003',
                'password' => Hash::make('ririn'),
                'role' => 'pekerja',
                'penangkaran_id' => 3,
            ],
        ];
        foreach ($PNK as $data) {
            User::create($data);
        }
    }
}
