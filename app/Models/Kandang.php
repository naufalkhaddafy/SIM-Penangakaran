<?php

namespace App\Models;

use App\Models\Penangkaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kandang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function penangkaran()
    {
        return $this->belongsTo(Penangkaran::class);
    }
}
