<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorieActeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorie_actes')->insert([
            'intitule' => 'ATTESTATION PROVISOIRE',
            'nombreCopies' => 1,
            'visas' => 0,
            'description' => 'Attestation provisoire',           

        ]);

        DB::table('categorie_actes')->insert([
            'intitule' => 'ATTESTATION DEFINITIVE',
            'nombreCopies' => 1,
            'visas' => 0,
            'description' => 'Attestation définitive',           

        ]);

        DB::table('categorie_actes')->insert([
            'intitule' => 'DIPLOME',
            'nombreCopies' => 1,
            'visas' => 1,
            'description' => 'Diplôme',           

        ]);
        
    }
}
