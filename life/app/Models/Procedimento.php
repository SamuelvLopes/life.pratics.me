<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'procedimento';

    protected $fillable = [
        'proc_nome',
        'proc_valor',
    ];
}
