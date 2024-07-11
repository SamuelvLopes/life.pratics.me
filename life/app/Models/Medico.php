<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Medico extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes;

    protected $table = 'medico';

    protected $primaryKey = 'med_codigo';

    protected $fillable = [
        'med_crm',
        'med_nome',
        'med_email',
        'med_password',
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'medico_especialidade', 'med_codigo', 'espec_codigo');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->med_password;
    }
}
