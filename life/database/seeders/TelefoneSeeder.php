<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Telefone;

class TelefoneSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 telefones
        Telefone::factory(1001)->create();
    }
}
