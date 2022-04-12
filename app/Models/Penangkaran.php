<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kandang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penangkaran extends Model
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];

    public function kandangs()
    {
        return $this->hasMany(Kandang::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pakans()
    {
        return $this->hasMany(Pakan::class);
    }
}
