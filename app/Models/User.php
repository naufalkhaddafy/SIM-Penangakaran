<?php

namespace App\Models;

use App\Models\Panduan;
use App\Models\Penangkaran;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function penangkaran()
    {
        return $this->belongsTo(Penangkaran::class);
    }

    public function pakans()
    {
        return $this->hasMany(Pakan::class);
    }
    public function panduans()
    {
        return $this->hasMany(Panduan::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
