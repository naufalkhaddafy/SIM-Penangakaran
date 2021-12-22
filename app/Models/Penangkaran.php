<?php

namespace App\Models;

use App\Models\Kandang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penangkaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Kandangs()
    {
        return $this->hasMany(Kandang::class);
    }
    public function tambahlokasipenangkaran($data)
    {
        return DB::table('penangkarans')->insert($data);
    }
    public function readlokasi(){
        return DB::table('penangkarans')->get();
    }
}
