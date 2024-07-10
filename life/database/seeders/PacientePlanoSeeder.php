<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;
use App\Models\PlanoSaude;
use App\Models\PacientePlano;

class PacientePlanoSeeder extends Seeder
{
    public function run()
    {
        $pacientes = Paciente::all();
        $planos = PlanoSaude::all();
        foreach($pacientes as $paciente){

            $planosSelecionado = $planos->random()->first();
            PacientePlano::factory()->create([
                'pac_codigo' => $paciente->pac_codigo, 
                'plano_codigo' => $planosSelecionado->plano_codigo,
            ]);
        }
    }
}
