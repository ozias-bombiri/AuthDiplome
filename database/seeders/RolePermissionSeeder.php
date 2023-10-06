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
        
        $roles = [
            'admin',
            'direction',
            'daoi',
            'authentification'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
       }
        
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
        
        $role_admin = Role::where('name', 'admin')->first();
     
        $all_permissions = Permission::pluck('id','id')->all();
   
        $role_admin->syncPermissions($all_permissions);

        $admin = User::create([
            'name' => 'Admin admin', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole([$role_admin->id]);

        
    }
}
