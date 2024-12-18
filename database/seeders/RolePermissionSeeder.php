<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Company Permissions
        Permission::firstOrCreate(['name' => 'create company']);
        Permission::firstOrCreate(['name' => 'view company']);
        Permission::firstOrCreate(['name' => 'update company']);
        Permission::firstOrCreate(['name' => 'delete company']);
    
        // Product Permissions
        Permission::firstOrCreate(['name' => 'create product']);
        Permission::firstOrCreate(['name' => 'view product']);
        Permission::firstOrCreate(['name' => 'update product']);
        Permission::firstOrCreate(['name' => 'delete product']);

        //Processes Permissions
        Permission::firstOrCreate(['name' => 'create process']);
        Permission::firstOrCreate(['name' => 'view process']);
        Permission::firstOrCreate(['name' => 'update process']);
        Permission::firstOrCreate(['name' => 'delete process']);
        // Floor Permissions
        Permission::firstOrCreate(['name' => 'create floor']);
        Permission::firstOrCreate(['name' => 'view floor']);
        Permission::firstOrCreate(['name' => 'update floor']);
        Permission::firstOrCreate(['name' => 'delete floor']);


        // Team Permissions
        Permission::firstOrCreate(['name' => 'create team']);
        Permission::firstOrCreate(['name' => 'view team']);
        Permission::firstOrCreate(['name' => 'update team']);
        Permission::firstOrCreate(['name' => 'delete team']);

        // Resource Permissions
        Permission::firstOrCreate(['name' => 'create resource']);
        Permission::firstOrCreate(['name' => 'view resource']);
        Permission::firstOrCreate(['name' => 'update resource']);
        Permission::firstOrCreate(['name' => 'delete resource']);

        // Roles
        $admin = Role::firstOrCreate(['name' => 'Administrator']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);


        // Assign Permissions to Administrator
        $admin->givePermissionTo([
            'create company',
            'view company',
            'update company',
            'delete company',
            'create product',
            'view product',
            'update product',
            'delete product',
            'create process',
            'view process',
            'update process',
            'delete process',
            'create floor',
            'view floor',
            'update floor',
            'delete floor',
            'create team',
            'view team',
            'update team',
            'delete team',
            'create resource',
            'view resource',
            'update resource',
            'delete resource',

        ]);

        // Assign Permissions to Manager
        $manager->givePermissionTo([
            'view company',
            'update company',
            'create product',
            'view product',
            'update product',
            'delete product',
            'create process',
            'view process',
            'update process',
            'create floor',
            'view floor',
            'update floor',
            'create team',
            'update team',
            'view team',
            'create resource',
            'view resource',
            'update resource',
            'delete resource',
        ]);
    }
}
