<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultaProcedimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consulta_procedimento';

    protected $fillable = [
        'proc_codigo',
        'cons_codigo',
    ];
}
