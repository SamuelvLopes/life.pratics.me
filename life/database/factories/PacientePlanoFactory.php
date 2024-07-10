<?php

namespace Database\Factories;

use App\Models\PacientePlano;
use App\Models\Paciente;
use App\Models\PlanoSaude;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacientePlanoFactory extends Factory
{
    protected $model = PacientePlano::class;

    public function definition()
    {
        return [
            'pac_codigo' => Paciente::factory(), // Cria ou utiliza um Paciente existente
            'plano_codigo' => PlanoSaude::factory(), // Cria ou utiliza um PlanoSaude existente
            'nr_contrato' => $this->faker->unique()->numerify('#-##.####/###'), // Número de contrato único
        ];
    }
}
