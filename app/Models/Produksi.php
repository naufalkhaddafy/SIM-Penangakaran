<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\Indukan;
use App\Models\Kandang;
use App\Enums\TelurStatus;
use App\Enums\ProduksiStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $casts = [
    //     'status_produksi'=>ProduksiStatus::class,
    //     'status_telur' =>TelurStatus::class,
    // ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class);
    }
    public function jadwal()
    {
        return $this->hasOne(Jadwal::class);
    }
    public function indukans()
    {
        return $this->hasOne(Indukan::class);
    }
}
