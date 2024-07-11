<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

use Illuminate\Support\Facades\Hash;
class PacienteSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 pacientes
        Paciente::factory()->create([
            'pac_email'=>'paciente@life.pratics.me',
            'pac_password'=>Hash::make('password'), 
        ]);
        Paciente::factory(1000)->create();
    }
}
