<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AnneeAcademiqueSeeder::class);
        $this->call(NiveauEtudeSeeder::class);
        $this->call(IesrSeeder::class);
        $this->call(EtablissementSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(UserSeeder::class);

    }
}
