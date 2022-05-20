<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indukan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class);
    }
    public function produksi()
    {
        return $this->belongsTo(Produksi::class);
    }
}
