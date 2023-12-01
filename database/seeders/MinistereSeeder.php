<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MinistereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ministeres')->insert([
            'sigle' => 'MESRI',
            'denomination' => 'Ministère de l\'Eseignement Supérieur de la Recherche et de l\'Innovation',           

        ]);
        
    }
}
