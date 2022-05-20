<?php

namespace App\Models;

use App\Models\Kandang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kebersihan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function kadang()
    {
        return $this->belongsTo(Kandang::class);
    }
}
