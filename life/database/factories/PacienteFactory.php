<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    public function definition()
    {
        return [
            'pac_nome' => $this->faker->name,
            'pac_data_nascimento' => $this->faker->date(),
            'pac_email'=>$this->faker->unique()->safeEmail,
            'pac_password'=>Hash::make('password'), 
        ];
    }
}
