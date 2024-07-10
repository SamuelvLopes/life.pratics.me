<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PlanoProcedimento;
use App\Models\PlanoSaude;
use App\Models\Procedimento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanoProcedimento>
 */
class PlanoProcedimentoFactory extends Factory
{
    
    protected $model = PlanoProcedimento::class;
    
    public function definition()
    {

        return [
            'plano_codigo' => PlanoSaude::factory(), // Cria ou utiliza um PlanoSaude existente
            'proc_codigo' => Procedimento::factory(), // Cria ou utiliza um Procedimento existente
        ];
    }
}
