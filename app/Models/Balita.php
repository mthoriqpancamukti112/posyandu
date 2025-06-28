<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = 'balita';
    protected $fillable = [
        'orangtua_id',
        'nik',
        'nama_anak',
        'jenis_kelamin',
        'tgl_lahir',
    ];

    public function orangtuas()
    {
        return $this->belongsTo(Orangtua::class, 'orangtua_id', 'id');
    }

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class);
    }
}