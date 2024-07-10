<?php

namespace Database\Factories;

use App\Models\ProcedimentoEspecialidade;
use App\Models\Procedimento;
use App\Models\Especialidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcedimentoEspecialidadeFactory extends Factory
{
    protected $model = ProcedimentoEspecialidade::class;

    public function definition()
    {
        return [
            'proc_codigo' => Procedimento::factory(), // Cria ou utiliza um Procedimento existente
            'espec_codigo' => Especialidade::factory(), // Cria ou utiliza uma Especialidade existente
        ];
    }
}
