<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcedimentoEspecialidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'procedimento_especialidade';

    protected $fillable = [
        'proc_codigo',
        'espec_codigo',
    ];
}
