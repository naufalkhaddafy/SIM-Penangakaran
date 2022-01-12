<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kandang()
    {
        return $this->belongTo(Kandang::class);
    }
}
