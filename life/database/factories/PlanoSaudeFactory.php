<?php

namespace Database\Factories;

use App\Models\PlanoSaude;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanoSaude>
 */
class PlanoSaudeFactory extends Factory
{

    protected $model = PlanoSaude::class;

    public function definition()
    {
        return [
            'plano_descricao' => $this->faker->company, 
        ];
    }
}
