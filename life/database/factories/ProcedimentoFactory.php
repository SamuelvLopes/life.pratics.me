<?php

namespace Database\Factories;


use App\Models\Procedimento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Procedimento>
 */
class ProcedimentoFactory extends Factory
{
    protected $model = Procedimento::class;

    public function definition()
    {
        return [
            'proc_nome' => $this->faker->word, // Nome do procedimento
            'proc_valor' => $this->faker->randomFloat(2, 50, 500), // Valor do procedimento entre 50 e 500
        ];
    }
}
