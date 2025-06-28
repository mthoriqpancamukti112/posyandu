<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{
    use HasFactory;

    protected $table = 'penimbangan';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'bidan_id',
        'balita_id',
        'tgl_timbang',
        'usia',
        'berat_badan',
        'tinggi_badan',
        'perkembangan',
        'keterangan',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bidans()
    {
        return $this->belongsTo(Bidan::class, 'bidan_id');
    }

    public function balitas()
    {
        return $this->belongsTo(Balita::class, 'balita_id');
    }
}
