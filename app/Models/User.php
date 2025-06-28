<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'bidan_id',
        'orangtua_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orangtua()
    {
        return $this->belongsTo(OrangTua::class, 'orangtua_id');
    }
    public function bidan()
    {
        return $this->belongsTo(Bidan::class, 'bidan_id');
    }
}