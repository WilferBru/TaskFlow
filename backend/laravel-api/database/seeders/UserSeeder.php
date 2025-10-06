<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name'     => 'Suj Prueba',
            'email'    => 'prueba@prueba.com',
            'password' => 'prueba123'
        ]);
    }
}
