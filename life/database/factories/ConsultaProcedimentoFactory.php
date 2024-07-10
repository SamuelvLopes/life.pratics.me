<?php

namespace Database\Factories;

use App\Models\ConsultaProcedimento;
use App\Models\Consulta;
use App\Models\Procedimento;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultaProcedimentoFactory extends Factory
{
    protected $model = ConsultaProcedimento::class;

    public function definition()
    {
        return [
            'consulta_id' => Consulta::inRandomOrder()->first()->id, // Utiliza uma Consulta existente
            'procedimento_id' => Procedimento::inRandomOrder()->first()->id, // Utiliza um Procedimento existente
        ];
    }
}
