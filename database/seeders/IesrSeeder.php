<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IesrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('iesrs')->insert([
            'sigle' => 'UNZ',
            'denomination' => 'Université Norbert ZONGO',
            'telephone' => '0000000',
            'email' => 'email@unz.bf',
            'adresse' => 'BP unz',
            'siteweb' => 'unz.bf',
            'logo' => 'Logo unz',
            'description' => 'Université de koudougou',

        ]);

        DB::table('iesrs')->insert([
            'sigle' => 'UNB',
            'denomination' => 'Université Nazi BONI',
            'telephone' => '0000000',
            'email' => 'email@unb.bf',
            'adresse' => 'BP unb',
            'siteweb' => 'unb.bf',
            'logo' => 'Logo unb',
            'description' => 'Université de Bobo',

        ]);

        DB::table('iesrs')->insert([
            'sigle' => 'UJKZ',
            'denomination' => 'Université Joseph KY ZERBO',
            'telephone' => '0000000',
            'email' => 'email@ujkz.bf',
            'adresse' => 'BP uj9kz',
            'siteweb' => 'ujkz.bf',
            'logo' => 'Logo ujkz',
            'description' => 'Université de Ouaga 1',

        ]);
    }
}
