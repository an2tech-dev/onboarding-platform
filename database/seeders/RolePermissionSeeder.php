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
    
        // Roles
        $admin = Role::firstOrCreate(['name' => 'Administrator']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);
    
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
    
        $manager->givePermissionTo([
            'view company',
            'update company',
            'create product',
            'view product',
            'update product',
            'delete product',
        ]);
    }
}