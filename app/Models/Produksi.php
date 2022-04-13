<?php

namespace App\Models;

use App\Enums\ProduksiStatus;
use App\Enums\TelurStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
