<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'view company']);
        Permission::create(['name' => 'update company']);
        Permission::create(['name' => 'delete company']);

        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Employee']);

        $admin = Role::findByName('Administrator');
        $admin->givePermissionTo([
            'create company',
            'view company',
            'update company',
            'delete company',
        ]);

        $manager = Role::findByName('Manager');
        $manager->givePermissionTo([
            'view company',
            'update company',
        ]);

    }
}
