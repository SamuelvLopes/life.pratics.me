<?php

namespace Database\Factories;

use App\Models\Telefone;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RelacionaTelefone;

class TelefoneFactory extends Factory
{
    protected $model = Telefone::class;

    public function definition()
    {
        return [
            't_telefone' => $this->faker->phoneNumber, // Número de telefone gerado pelo Faker
        ];
    }
}
