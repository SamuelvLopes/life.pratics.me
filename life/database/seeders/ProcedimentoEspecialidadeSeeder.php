<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procedimento;
use App\Models\Especialidade;
use App\Models\ProcedimentoEspecialidade;

class ProcedimentoEspecialidadeSeeder extends Seeder
{
    public function run()
    {
        $procedimentos = Procedimento::all();
        $especialidades = Especialidade::all();

        foreach ($procedimentos as $procedimento) {
            $especialidadesSelecionadas = $especialidades->random(rand(1, 3));
            foreach ($especialidadesSelecionadas as $especialidade) {
                ProcedimentoEspecialidade::factory()->create([
                    'proc_codigo' => $procedimento->proc_codigo,
                    'espec_codigo' => $especialidade->espec_codigo,
                ]);
            }
        }
    }
}
