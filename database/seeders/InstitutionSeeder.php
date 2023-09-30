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
        DB::table('institutions')->insert([
            'sigle' => 'UNZ',
            'denomination' => 'Université Norbert ZONGO',
            'type' => 'IESR',
            'telephone' => '0000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'siteweb' => 'unz.bf',
            'logo' => 'Logo unz',
            'description' => 'Université de koudougou',
            'parent_id' => null,

        ]);

        DB::table('institutions')->insert([
            'sigle' => 'UNB',
            'denomination' => 'Université Nazi BONI',
            'type' => 'IESR',
            'telephone' => '0000000',
            'email' => 'email@unb.bf',
            'adresse' => 'BP unb',
            'siteweb' => 'unb.bf',
            'logo' => 'Logo unb',
            'description' => 'Université de Bobo',
            'parent_id' => null,

        ]);

        DB::table('institutions')->insert([
            'sigle' => 'UJKZ',
            'denomination' => 'Université Joseph KY ZERBO',
            'type' => 'IESR',
            'telephone' => '0000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP uj9kz',
            'siteweb' => 'ujkz.bf',
            'logo' => 'Logo ujkz',
            'description' => 'Université de Ouaga 1',
            'parent_id' => null,

        ]);

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

            'sigle' => 'UFR-SJPEG',
            'denomination' => 'UFR Sciences Economiques et de Gestion',
            'telephone' => '00000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP unz',
            'type' => 'UFR',
            'logo' => 'Logo ujkz',
            'description' => 'SEG Université de ouaga',
            'parent_id' => 3

        ]);
    }
}
