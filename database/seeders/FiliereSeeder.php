<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Filieres ufr lsh unz
        DB::table('filieres')->insert([
            'intitule' => 'Histoire et Archéologie',
            'sigle' => 'Hist-Arch',
            'description' => 'Histoire et Archéologie',
            'institution_id' =>2

        ]);
        DB::table('filieres')->insert([
            'intitule' => 'Lettres Modernes',
            'sigle' => 'LM',
            'description' => 'Lettres Modernes',
            'institution_id' =>2

        ]);
        DB::table('filieres')->insert([
            'intitule' => 'Géographie',
            'sigle' => 'Geo',
            'description' => 'Géographie',
            'institution_id' =>2

        ]);

        //filieres ufr st unz

        DB::table('filieres')->insert([
            'intitule' => 'Mathématiques Physiques Chimie Informatique',
            'sigle' => 'MPCI',
            'description' => 'Mathématiques Physiques Chimie Informatique',
            'institution_id' =>3

        ]);
        DB::table('filieres')->insert([
            'intitule' => 'Sciences de la Vie et de la Terre',
            'sigle' => 'SVT',
            'description' => 'Sciences de la Vie et de la Terre',
            'institution_id' =>3

        ]);

        
    }
}
