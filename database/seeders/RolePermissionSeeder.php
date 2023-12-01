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
            'create-parcours',
            'edit-parcours',
            'delete-parcours',
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
            'direction',
            'daoi',
            'authentification'
        ];
        //Role admin         
        $adminRole = Role::create(['name' => 'admin']);
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

        //Role direction pour l'émission des attestation provisoires
        $directionRole = Role::create(['name' => 'direction']);
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
        $daoiRole = Role::create(['name' => 'daoi']);
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
        $authentificationRole = Role::create(['name' => 'authentification']);
        $authentificationRole->givePermissionTo([

            'check-attestation-provisoires',
            'check-attestation-definitives',
            'check-attestation-diplome',
            'generate-rapport'
        ]);
        
        $superAdminRole = Role::create(['name' => 'superAdmin']);
        
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
