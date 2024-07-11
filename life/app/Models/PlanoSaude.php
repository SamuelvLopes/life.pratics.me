<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanoSaude extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plano_saude';

    protected $primaryKey = 'plano_codigo';
    
    protected $fillable = [
        'plano_descricao',
    ];
}
