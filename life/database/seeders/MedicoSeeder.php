<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;

use Illuminate\Support\Facades\Hash;

class MedicoSeeder extends Seeder
{
    public function run()
    {
        Medico::factory()->create([
            'med_email' => 'medico@life.pratics.me',
            'med_password' => Hash::make('password'), // Criptografando a senha
        ]);
        Medico::factory(100)->create();
    }
}
