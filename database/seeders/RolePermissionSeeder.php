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
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'view company']);
        Permission::create(['name' => 'update company']);
        Permission::create(['name' => 'delete company']);

        // Product Permissions
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);

        // Roles
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Employee']);

        // Assign Permissions to Administrator
        $admin = Role::findByName('Administrator');
        $admin->givePermissionTo([
            'create company',
            'view company',
            'update company',
            'delete company',
            'create product',
            'view product',
            'update product',
            'delete product',
        ]);

        // Assign Permissions to Manager (limited to viewing and updating companies/products)
        $manager = Role::findByName('Manager');
        $manager->givePermissionTo([
            'view company',
            'update company',
            'view product',
            'update product',
        ]);
    }
}