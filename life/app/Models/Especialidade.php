<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Especialidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'especialidade';

    protected $primaryKey = 'espec_codigo';

    protected $fillable = [
        'espec_nome',
    ];

    public function procedimentos()
    {
        return $this->belongsToMany(Procedimento::class, 'procedimento_especialidade', 'espec_codigo', 'proc_codigo');
    }
}
