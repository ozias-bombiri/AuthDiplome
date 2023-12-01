<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauEtudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('niveau_etudes')->insert([
            'intitule' => 'Licence',
            'credit' => 180,
            'description' => 'Licence'

        ]);
        DB::table('niveau_etudes')->insert([
            'intitule' => 'Master',
            'credit' => 120,
            'description' => 'Master'

        ]);
        DB::table('niveau_etudes')->insert([
            'intitule' => 'Doctorat',
            'credit' => 180,
            'description' => 'Doctorat '

        ]);
        
    }
}
