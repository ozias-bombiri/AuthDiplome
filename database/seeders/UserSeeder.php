<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'nom' => 'bozi',
            'prenom'=> 'scolarite',
            'telephone' => '0000000',
            'email' => 'obombiri@gmail.com',
            'statut' => 'Active',
            'institution_id' => 4,
            'password' => Hash::make('admin'),

        ]);
        $role_direction = Role::where('name', 'SCOLARITE')->first();
        $user->assignRole([$role_direction->id]);

        $user = User::create([
            'nom' => 'tebda',
            'prenom'=> 'directeur',
            'telephone' => '0000000',
            'email' => 'tebda@gmail.com',
            'statut' => 'Active',
            'institution_id' => 4,
            'password' => Hash::make('admin'),

        ]);
        $role_direction = Role::where('name', 'SCOLARITE')->first();
        $user->assignRole([$role_direction->id]);

        $user = User::create([
            'nom' => 'User1',
            'prenom'=> 'STD',
            'telephone' => '0000000',
            'email' => 'user1@exemple.com',
            'statut' => 'Active',
            'institution_id' => 1,
            'password' => Hash::make('admin'),

        ]);
        $role_daoi = Role::where('name', 'DAOI')->first();
        $user->assignRole([$role_daoi->id]);

        $user = User::create([
            'nom' => 'User 2',
            'prenom'=> 'DAOI',
            'telephone' => '0000000',
            'email' => 'user2@exemple.com',
            'statut' => 'Active',
            'institution_id' => 1,
            'password' => Hash::make('admin'),

        ]);
        $role_daoi = Role::where('name', 'DAOI')->first();
        $user->assignRole([$role_daoi->id]);


        $user = User::create([
            'nom' => 'User 3',
            'prenom'=> 'VP-EIP',
            'telephone' => '0000000',
            'email' => 'user3@exemple.com',
            'statut' => 'Active',
            'institution_id' => 1,
            'password' => Hash::make('admin'),

        ]);
        $role_daoi = Role::where('name', 'DAOI')->first();
        $user->assignRole([$role_daoi->id]);


        $user = User::create([
            'nom' => 'User 4',
            'prenom'=> 'President',
            'telephone' => '0000000',
            'email' => 'user4@exemple.com',
            'statut' => 'Active',
            'institution_id' => 2,
            'password' => Hash::make('admin'),

        ]);
        $role_auth = Role::where('name', 'DAOI')->first();
        $user->assignRole([$role_auth->id]);    
    }
}
