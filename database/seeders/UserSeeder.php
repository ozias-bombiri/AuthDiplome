<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'obombiri@gmail.com',
            'statut' => 'Active',
            //'profile_id' => 1,
            'etablissement_id' => 1,
            'password' => Hash::make('admin'),

        ]);

        DB::table('users')->insert([
            'name' => 'tebda',
            'email' => 'tebda@gmail.com',
            'statut' => 'Active',
            //'profile_id' => 1,
            'etablissement_id' => 1,
            'password' => Hash::make('admin'),

        ]);

        DB::table('users')->insert([
            'name' => 'STD user1',
            'email' => 'user1@exemple.com',
            'statut' => 'Active',
            //'profile_id' => 2,
            'etablissement_id' => 1,
            'password' => Hash::make('admin'),

        ]);

        DB::table('users')->insert([
            'name' => 'AUTH user2',
            'email' => 'user2@exemple.com',
            'statut' => 'Active',
            //'profile_id' => 3,
            'etablissement_id' => 1,
            'password' => Hash::make('admin'),

        ]);

        DB::table('users')->insert([
            'name' => 'STD user3',
            'email' => 'user3@exemple.com',
            'statut' => 'Active',
            //'profile_id' => 2,
            'etablissement_id' => 2,
            'password' => Hash::make('admin'),

        ]);

        DB::table('users')->insert([
            'name' => 'AUTH user4',
            'email' => 'user4@exemple.com',
            'statut' => 'Active',
            //'profile_id' => 3,
            'etablissement_id' => 2,
            'password' => Hash::make('admin'),

        ]);
    }
}
