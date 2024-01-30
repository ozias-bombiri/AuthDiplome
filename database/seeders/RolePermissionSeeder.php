<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Création des permissions

        $permissions = [
            'GESTION_PARCOURS',            
            'GESTION_INSCRIPTION',
            'GESTION_RESULTAT_ACADEMIQUE',
            'GESTION_RETRAIT_ACTE', 
            'GESTION_PV',
            'CREATION_ATTESTATION_PROVISOIRE', 
            'CONSULTATION_ATTESTATION_PROVISOIRE', 
            'CONSULTATION_PV',
            'CONSULTATION_ATTESTATION_DEFINITIVE',
            'CREATION_ATTESTATION_DEFINITIVE', 
            'CREATION_DIPLOME',
            'CONSULTATION_DIPLOME',            
            'GESTION_SIGNATAIRE',
            'GESTION_TIMBRE',
            'GESTION_NUMEROTEUR',
            'GESTION_ANNEE_ACADEMIQUE',
            'GESTION_UTILISATEUR',
            'GESTION_INSTITUTION',
            'GESTION_VISA',
            'GESTION_NIVEAU_ETUDE',
            'AUTHENTIFICATION',
            
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
        
        $roles = [
            'ADMIN',
            'SCOLARITE',
            'DAOI',
            'SUPERADMIN'
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
       }

        //Role admin         
        $adminRole = Role::where('name', 'ADMIN')->first();
        $adminRole->givePermissionTo([
            'GESTION_ANNEE_ACADEMIQUE',
            'GESTION_INSTITUTION',
            'GESTION_UTILISATEUR',
            'GESTION_SIGNATAIRE',
            'GESTION_TIMBRE',
            'GESTION_NUMEROTEUR',
            'GESTION_NIVEAU_ETUDE',
        ]);

        //Role scolarite pour l'émission des attestation provisoires
        $directionRole = Role::where('name', 'SCOLARITE')->first();
        $directionRole->givePermissionTo([
            'GESTION_PARCOURS',            
            'GESTION_INSCRIPTION',
            'GESTION_RESULTAT_ACADEMIQUE',
            'GESTION_RETRAIT_ACTE', 
            'GESTION_PV',
            'CREATION_ATTESTATION_PROVISOIRE', 
            'CONSULTATION_ATTESTATION_PROVISOIRE', 
            'CONSULTATION_PV',
            'AUTHENTIFICATION',
        ]);

        //Role daoi pour l'émission des attestations définitives et des diplômes
        $daoiRole = Role::where('name', 'DAOI')->first();
        $daoiRole->givePermissionTo([
            'CONSULTATION_ATTESTATION_PROVISOIRE', 
            'CONSULTATION_PV',
            'CREATION_ATTESTATION_DEFINITIVE', 
            'CREATION_DIPLOME',            
            'CONSULTATION_ATTESTATION_DEFINITIVE',
            'CONSULTATION_DIPLOME',
            'AUTHENTIFICATION',
        ]);
        
        
        $role_superadmin = Role::where('name', 'SUPERADMIN')->first();
     
        $all_permissions = Permission::pluck('id','id')->all();
   
        $role_superadmin->syncPermissions($all_permissions);

        $admin = User::create([
            'nom' => 'Admin',
            'prenom'=> 'Admin',
            'telephone' => '0000000', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole([$role_superadmin->id]);
        
    }
}
