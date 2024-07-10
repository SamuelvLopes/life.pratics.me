<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consulta;
use App\Models\Procedimento;
use App\Models\ConsultaProcedimento;

class ConsultaProcedimentoSeeder extends Seeder
{
    public function run()
    {
        $consultas = Consulta::all();
        $procedimentos = Procedimento::all();

        foreach ($consultas as $consulta) {
            $procedimentosSelecionados = $procedimentos->random(rand(1, 3));
            foreach ($procedimentosSelecionados as $procedimento) {
                ConsultaProcedimento::factory()->create([
                    'consulta_id' => $consulta->id,
                    'procedimento_id' => $procedimento->id,
                ]);
            }
        }
    }
}
