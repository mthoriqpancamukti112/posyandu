<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Bidan extends Authenticatable
{
    use Notifiable;

    protected $table = 'bidan';
    protected $fillable = [
        'nik',
        'nip',
        'nama_bidan',
        'tgl_lahir',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'bidan_id');
    }
}
