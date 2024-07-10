<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    public function definition()
    {
        return [
            'pac_nome' => $this->faker->name, // Nome do paciente
            'pac_data_nascimento' => $this->faker->date(), // Data de nascimento do paciente
        ];
    }
}
