<?php

namespace Database\Factories;

use App\Models\RelacionaTelefone;
use App\Models\Telefone;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\PlanoSaude;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelacionaTelefoneFactory extends Factory
{
    protected $model = RelacionaTelefone::class;

    public function definition()
    {
        return [
            't_codigo' => Telefone::factory(),
            'rt_descricao' => $this->faker->word,
            'pac_codigo' =>  null,
            'med_codigo' => null,
            'plano_codigo' =>  null,
        ];
    }
}
