<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PlanoSaudeSeeder::class,
            ProcedimentoSeeder::class,
            EspecialidadeSeeder::class,
            MedicoSeeder::class,
            PacienteSeeder::class,
            TelefoneSeeder::class,
            ConsultaSeeder::class,
            PacientePlanoSeeder::class,
            PlanoProcedimentoSeeder::class,
            ProcedimentoEspecialidadeSeeder::class,
            MedicoEspecialidadeSeeder::class,
            RelacionaTelefoneSeeder::class,
        ]);
    }
}
