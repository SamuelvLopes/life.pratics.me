<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Telefone;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\PlanoSaude;
use App\Models\RelacionaTelefone;

class RelacionaTelefoneSeeder extends Seeder
{
    public function run()
    {
        $telefones = Telefone::all();
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        $planos = PlanoSaude::all();

        foreach ($telefones as $telefone) {
            $vinculado = rand(1, 3);
            $vinculos = [];

            if ($vinculado == 1) {
                $vinculos['pac_codigo'] = $pacientes->random(1)->first()->id;
            }
            if ($vinculado == 2) {
                $vinculos['med_codigo'] = $medicos->random(1)->first()->id;
            }
            if ($vinculado == 3) {
                $vinculos['plano_codigo'] = $planos->random(1)->first()->id;
            }

            RelacionaTelefone::factory()->create(array_merge([
                't_codigo' => $telefone->t_codigo,
            ], $vinculos));
        }
    }
}
