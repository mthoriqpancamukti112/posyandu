<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrangTua extends Authenticatable
{
    use Notifiable;

    protected $table = 'orangtua';
    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'nik',
        'nama_ortu',
        'tgl_lahir',
        'no_hp',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'orangtua_id');
    }

    public function balitas()
    {
        return $this->hasMany(Balita::class, 'orangtua_id');
    }
}
