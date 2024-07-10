<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procedimento;
use App\Models\PlanoSaude;
use App\Models\PlanoProcedimento;

class PlanoProcedimentoSeeder extends Seeder
{
    public function run()
    {
        $procedimentos = Procedimento::all();
        $planos = PlanoSaude::all();

        foreach ($procedimentos as $procedimento) {
            $planosSelecionados = $planos->random(rand(3, 5));
            foreach ($planosSelecionados as $plano) {
                PlanoProcedimento::factory()->create([
                    'plano_codigo' => $plano->plano_codigo,
                    'proc_codigo' => $procedimento->proc_codigo,
                ]);
            }
        }
    }
}
