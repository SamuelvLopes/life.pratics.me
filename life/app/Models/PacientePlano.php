<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacientePlano extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paciente_plano';

    protected $fillable = [
        'pac_codigo',
        'plano_codigo',
        'nr_contrato',
    ];
}
