<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicoEspecialidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medico_especialidade';

    protected $fillable = [
        'med_codigo',
        'espec_codigo',
    ];
}
