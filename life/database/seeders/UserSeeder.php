<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'email'=>'admin@life.pratics.me',
            'password'=>Hash::make('password'),
        ]);
    }
}
