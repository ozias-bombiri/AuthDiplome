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
            'description' => 'Licence'

        ]);
        DB::table('niveau_etudes')->insert([
            'intitule' => 'Master',
            'description' => 'Master'

        ]);
        DB::table('niveau_etudes')->insert([
            'intitule' => 'Doctorat',
            'description' => 'Doctorat '

        ]);
        
    }
}
