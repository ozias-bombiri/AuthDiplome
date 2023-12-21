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
        $this->call(MinistereSeeder::class);
        $this->call(AnneeAcademiqueSeeder::class);
        $this->call(CategorieActeSeeder::class);
        $this->call(NiveauEtudeSeeder::class);
        $this->call(VisaSeeder::class);
        $this->call(InstitutionSeeder::class);        
        $this->call(FiliereSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        
    }
}
