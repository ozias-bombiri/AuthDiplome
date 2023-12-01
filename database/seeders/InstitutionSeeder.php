<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //IESR UNZ
        DB::table('institutions')->insert([
            'sigle' => 'UNZ',
            'denomination' => 'Université Norbert ZONGO',
            'type' => 'IESR',
            'telephone' => '0000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'siteWeb' => 'unz.bf',
            'logo' => 'Logo unz',
            'description' => 'Université de koudougou',
            'parent_id' => null,

        ]);

        /* Etablissements de UNZ */

        DB::table('institutions')->insert([

            'sigle' => 'UFR-LSH',
            'denomination' => 'UFR Lettres et Sciences Humaines',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'LSH Université de koudougou',
            'parent_id' => 1

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'UFR-SEG',
            'denomination' => 'UFR Sciences Economiques et de Gestion',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'SEG Université de koudougou',
            'parent_id' => 1

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'UFR-ST',
            'denomination' => 'UFR Sciences et Technologies',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'LSH Université de koudougou',
            'parent_id' => 1

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'IUT-UNZ',
            'denomination' => 'Institut Universitaire de Technologies',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'Institut',
            'logo' => 'Logo unz',
            'description' => 'IUT Université de koudougou',
            'parent_id' => 1

        ]);

        // IESR UNB

        DB::table('institutions')->insert([
            'sigle' => 'UNB',
            'denomination' => 'Université Nazi BONI',
            'type' => 'IESR',
            'telephone' => '0000000',
            'email' => 'email@unb.bf',
            'adresse' => 'BP unb',
            'siteWeb' => 'unb.bf',
            'logo' => 'Logo unb',
            'description' => 'Université de Bobo',
            'parent_id' => null,

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'IUT-UNB',
            'denomination' => 'Institut Universitaire de Technologies',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'Institut',
            'logo' => 'Logo unz',
            'description' => 'IUT Université de bobo',
            'parent_id' => 2

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'ESI',
            'denomination' => 'Ecole Supérieure d\'Informatique',
            'telephone' => '00000000',
            'email' => 'email@unb.bf',
            'adresse' => 'BP unb',
            'type' => 'Ecole',
            'logo' => 'Logo unb',
            'description' => 'ESI bobo',
            'parent_id' => 2

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'UFR-SJPEG',
            'denomination' => 'UFR Sciences Juridiques et Politiques',
            'telephone' => '00000000',
            'email' => 'email@unb.bf',
            'adresse' => 'BP unb',
            'type' => 'UFR',
            'logo' => 'Logo unb',
            'description' => 'UFR-SJPEG bobo',
            'parent_id' => 2

        ]);

        //IESR UJKZ

        DB::table('institutions')->insert([
            'sigle' => 'UJKZ',
            'denomination' => 'Université Joseph KY ZERBO',
            'type' => 'IESR',
            'telephone' => '0000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP uj9kz',
            'siteWeb' => 'ujkz.bf',
            'logo' => 'Logo ujkz',
            'description' => 'Université de Ouaga 1',
            'parent_id' => null,

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'UFR-LAC',
            'denomination' => 'UFR Lettres Arts et Communication',
            'telephone' => '00000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP ujkz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'UFR-LAC Université ouaga 1',
            'parent_id' => 3

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'UFR-SEG',
            'denomination' => 'UFR Sciences Economiques et de Gestion',
            'telephone' => '00000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo unz',
            'description' => 'SEG Université de koudougou',
            'parent_id' => 3

        ]);

        DB::table('institutions')->insert([

            'sigle' => 'UFR-SJPEG',
            'denomination' => 'UFR Sciences Economiques et de Gestion',
            'telephone' => '00000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo ujkz',
            'description' => 'SJPEG Université de ouaga',
            'parent_id' => 3

        ]);
    }
}
