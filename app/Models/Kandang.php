<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Penangkaran;
use App\Enums\KandangStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kandang extends Model
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    // protected $casts= [
    //     'kategori'=>KandangStatus::class,
    // ];

    public function penangkaran()
    {
        return $this->belongsTo(Penangkaran::class);
    }

    public function produksis()
    {
        return $this->hasMany(Produksi::class);
    }
    public function kebersihans()
    {
        return $this->hasMany(Kebersihan::class);
    }
}
