<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consulta';

    protected $fillable = [
        'cons_horario',
        'cons_particular',
        'pac_codigo',
        'med_codigo',
    ];
}
