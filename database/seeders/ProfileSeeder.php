<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'intitule' => 'admin',
            'description' => 'Administrateur',

        ]);

        DB::table('profiles')->insert([
            'intitule' => 'STD',
            'description' => 'Service titres et diplômes',

        ]);

        DB::table('profiles')->insert([
            'intitule' => 'Authentificateur',
            'description' => 'Authentificateur de diplôme et attestation',

        ]);
    }
}
