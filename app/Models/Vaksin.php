<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    use HasFactory;

    protected $table = 'vaksin';
    protected $fillable = [
        'jenis_vaksin',
        'stok',
    ];

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class, 'vaksin_id');
    }
}