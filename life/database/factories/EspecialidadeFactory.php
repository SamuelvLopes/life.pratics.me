<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Especialidade;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especialidade>
 */
class EspecialidadeFactory extends Factory
{

    protected $model = Especialidade::class;
   
    public function definition()
    {
            return [
                'espec_nome' => $this->faker->word .' ' .  $this->faker->word, // Nome da especialidade
            ];
    }
    
}
