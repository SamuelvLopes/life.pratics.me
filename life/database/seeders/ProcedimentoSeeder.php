<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procedimento;

class ProcedimentoSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 procedimentos
        Procedimento::factory(2000)->create();
    }
}
