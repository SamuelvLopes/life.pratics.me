<?php

namespace Database\Factories;

use App\Models\Medico;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;

class MedicoFactory extends Factory
{
    protected $model = Medico::class;

    public function definition()
    {
        return [
            'med_crm' => $this->faker->unique()->numerify('CRM#####'), 
            'med_nome' => $this->faker->name, 
            'med_email'=>$this->faker->unique()->safeEmail,
            'med_password'=>Hash::make('password'),
        ];
    }
}
