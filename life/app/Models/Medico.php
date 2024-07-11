<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
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
}
