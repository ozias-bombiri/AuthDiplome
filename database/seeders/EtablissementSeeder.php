<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('etablissements')->insert([

            'sigle' => 'UFR-LSH',
            'denomination' => 'UFR Lettres et Sciences Humaines',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'LSH Université de koudougou',
            'iesr_id' => 1

        ]);

        DB::table('etablissements')->insert([

            'sigle' => 'UFR-SEG',
            'denomination' => 'UFR Sciences Economiques et de Gestion',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'SEG Université de koudougou',
            'iesr_id' => 1

        ]);

        DB::table('etablissements')->insert([

            'sigle' => 'UFR-SJPEG',
            'denomination' => 'UFR Sciences Economiques et de Gestion',
            'telephone' => '00000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo ujkz',
            'description' => 'SEG Université de ouaga',
            'iesr_id' => 3

        ]);
    }
}
