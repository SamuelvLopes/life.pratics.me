<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanoProcedimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plano_procedimento';

    protected $fillable = [
        'plano_codigo',
        'proc_codigo',
    ];
}
