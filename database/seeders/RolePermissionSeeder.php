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
            'create-proces-verbal',
            'view-proces-verbal', 
            'edit-proces-verbal', 
            'delete-proces-verbal',
            'view-all-proces-verbal',
            'view-resultat-proces-verbal', 
            'add-resultat-proces-verbal',
            'create-parcours',
            'edit-parcours',
            'delete-parcours',
            'add-proces-verbal',
            'create-users',
            'edit-users',
            'delete-users',
            'disable-users',
            'create-institutions',
            'edit-institutions',
            'delete-institutions',
            'create-annees',
            'edit-annees',
            'delete-annees',
            'create-niveaux',
            'edit-niveaux',
            'delete-niveaux',
            'create-signataires',
            'edit-signataires',
            'delete-signataires',
            'disable-signataires',
            
            'create-resultats',
            'edit-resultats',
            'delete-resultats',
            'create-attestation-provisoires',
            'edit-attestation-provisoires',
            'delete-attestation-provisoires',
            'generate-attestation-provisoires',
            'create-attestation-definitives',
            'edit-attestation-definitives',
            'delete-attestation-definitives',
            'generate-attestation-definitives',
            'create-diplomes',
            'edit-diplomes',
            'delete-diplomes',
            'generate-diplomes',
            'check-attestation-provisoires',
            'check-attestation-definitives',
            'check-attestation-diplome',
            'generate-rapport'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
        
        $roles = [
            'superAdmin',
            'admin',
            'scolarite',
            'directeur',
            'std',
            'daoi',
            'vpeip',
            'president',
            'authentification'
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
       }

        //Role admin         
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'disable-users',
            'create-institutions',
            'edit-institutions',
            'delete-institutions',
            'create-annees',
            'edit-annees',
            'delete-annees',
            'create-niveaux',
            'edit-niveaux',
            'delete-niveaux',
            'create-signataires',
            'edit-signataires',
            'delete-signataires',
            'disable-signataires',
        ]);

        //Role scolarite pour l'émission des attestation provisoires
        $directionRole = Role::where('name', 'scolarite')->first();
        $directionRole->givePermissionTo([
            'create-parcours',
            'edit-parcours',
            'delete-parcours',
            'create-resultats',
            'edit-resultats',
            'delete-resultats',
            'create-attestation-provisoires',
            'edit-attestation-provisoires',
            'delete-attestation-provisoires',
            'generate-attestation-provisoires'
        ]);

        //Role daoi pour l'émission des attestations définitives et des diplômes
        $daoiRole = Role::where('name', 'std')->first();
        $daoiRole->givePermissionTo([
            'create-attestation-definitives',
            'edit-attestation-definitives',
            'delete-attestation-definitives',
            'generate-attestation-definitives',
            'create-diplomes',
            'edit-diplomes',
            'delete-diplomes',
            'generate-diplomes'
        ]);

        // Role authentification pour l'authentification des documents
        $authentificationRole = Role::where('name', 'authentification')->first();
        $authentificationRole->givePermissionTo([

            'check-attestation-provisoires',
            'check-attestation-definitives',
            'check-attestation-diplome',
            'generate-rapport'
        ]);
        
        
        $role_superadmin = Role::where('name', 'superAdmin')->first();
     
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
