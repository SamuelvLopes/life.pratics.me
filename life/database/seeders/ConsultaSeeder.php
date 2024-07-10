<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consulta;

class ConsultaSeeder extends Seeder
{
    public function run()
    {
        Consulta::factory(10000)->create();
    }
}
