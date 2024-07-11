<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Paciente extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'paciente';
    protected $primaryKey = 'pac_codigo';

    protected $fillable = [
        'pac_nome',
        'pac_data_nascimento',
        'pac_email',
        'pac_password',
    ];

    protected $hidden = [
        'pac_password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->pac_password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
