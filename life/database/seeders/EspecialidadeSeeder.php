<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidade;

class EspecialidadeSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 especialidades
        Especialidade::factory(500)->create();
    }
}
