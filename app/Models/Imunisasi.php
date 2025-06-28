<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi';
    protected $fillable = [
        'user_id',
        'bidan_id',
        'balita_id',
        'vaksin_id',
        'tanggal',
        'kondisi',
        'usia',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function balitas()
    {
        return $this->belongsTo(Balita::class, 'balita_id');
    }

    public function bidans()
    {
        return $this->belongsTo(Bidan::class, 'bidan_id');
    }

    public function orangtuas()
    {
        return $this->belongsTo(OrangTua::class, 'orangtua_id');
    }

    public function vaksins()
    {
        return $this->belongsTo(Vaksin::class, 'vaksin_id');
    }
}
