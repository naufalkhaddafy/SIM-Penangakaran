<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'nama_lengkap' => 'admin',
            'username' =>'admin',
            'nohp' =>'001',
            'password' =>Hash::make('admin'),
            'role' =>'pemilik',
            'penangkaran_id' =>null,
        ]);
    }
}
