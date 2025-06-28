<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'user_id',
        'bidan_id',
        'title',
        'message',
        'start',
        'lokasi',
        'keterangan',
        'color',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bidans()
    {
        return $this->belongsTo(Bidan::class, 'bidan_id');
    }
}
