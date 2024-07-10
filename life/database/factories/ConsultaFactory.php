<?php

namespace Database\Factories;

use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultaFactory extends Factory
{
    protected $model = Consulta::class;

    public function definition()
    {
        return [
            'cons_horario' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'cons_particular' => $this->faker->boolean,
            'pac_codigo' => Paciente::inRandomOrder()->first()->pac_codigo, 
            'med_codigo' => Medico::inRandomOrder()->first()->med_codigo,
        ];
    }
}
