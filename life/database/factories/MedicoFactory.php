<?php

namespace Database\Factories;

use App\Models\Medico;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoFactory extends Factory
{
    protected $model = Medico::class;

    public function definition()
    {
        return [
            'med_crm' => $this->faker->unique()->numerify('CRM#####'), 
            'med_nome' => $this->faker->name, 
        ];
    }
}
