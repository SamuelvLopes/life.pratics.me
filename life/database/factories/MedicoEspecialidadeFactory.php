<?php

namespace Database\Factories;

use App\Models\MedicoEspecialidade;
use App\Models\Medico;
use App\Models\Especialidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoEspecialidadeFactory extends Factory
{
    protected $model = MedicoEspecialidade::class;

    public function definition()
    {
        return [
            'med_codigo' => Medico::factory(), // Cria ou utiliza um Medico existente
            'espec_codigo' => Especialidade::factory(), // Cria ou utiliza uma Especialidade existente
        ];
    }
}
