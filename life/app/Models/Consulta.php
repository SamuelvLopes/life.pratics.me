<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consulta';

    protected $primaryKey = 'cons_codigo';

    protected $fillable = [
        'cons_horario',
        'cons_particular',
        'pac_codigo',
        'med_codigo',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pac_codigo', 'pac_codigo');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'med_codigo', 'med_codigo');
    }

    public function procedimentos()
    {
        return $this->belongsToMany(Procedimento::class, 'consulta_procedimento', 'cons_codigo', 'proc_codigo');
    }
}
