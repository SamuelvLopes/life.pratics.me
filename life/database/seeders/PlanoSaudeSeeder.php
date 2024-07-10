<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanoSaude;

class PlanoSaudeSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 planos de saúde
        PlanoSaude::factory(50)->create();
    }
}
