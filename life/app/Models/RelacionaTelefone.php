<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelacionaTelefone extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'relaciona_telefone';

    protected $fillable = [
        'rt_descricao',
        'pac_codigo',
        'plano_codigo',
        'med_codigo',
        't_codigo',
    ];
}
