<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AnneeAcademiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('annee_academiques')->insert([
            'intitule' => '2020-2021',
            'debut' => 'Octobre 2020',
            'fin' => 'Juillet 2021'

        ]);
        DB::table('annee_academiques')->insert([
            'intitule' => '2021-2022',
            'debut' => 'Octobre 2021',
            'fin' => 'Juillet 2022'

        ]);
        DB::table('annee_academiques')->insert([
            'intitule' => '2022-2023',
            'debut' => 'Octobre 2022',
            'fin' => 'Juillet 2023'

        ]);
        DB::table('annee_academiques')->insert([
            'intitule' => '2023-2024',
            'debut' => 'Octobre 2023',
            'fin' => 'Juillet 2024'

        ]);
    }
}
