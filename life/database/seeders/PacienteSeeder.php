<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 pacientes
        Paciente::factory(1000)->create();
    }
}
