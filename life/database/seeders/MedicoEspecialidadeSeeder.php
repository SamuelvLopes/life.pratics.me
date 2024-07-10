<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;
use App\Models\Especialidade;
use App\Models\MedicoEspecialidade;

class MedicoEspecialidadeSeeder extends Seeder
{
    public function run()
    {
        $medicos = Medico::all();
        $especialidades = Especialidade::all();

        foreach ($medicos as $medico) {
            $especialidadesSelecionadas = $especialidades->random(rand(1, 3));
            foreach ($especialidadesSelecionadas as $especialidade) {
                MedicoEspecialidade::factory()->create([
                    'med_codigo' => $medico->med_codigo,
                    'espec_codigo' => $especialidade->espec_codigo,
                ]);
            }
        }
    }
}
