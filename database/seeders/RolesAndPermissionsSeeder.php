<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'Administrator']);
        $managerRole = Role::create(['name' => 'Manager']);
        $employeeRole = Role::create(['name' => 'Employee']);

        $permissions = [
            'manage companies',
            'view company data',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->givePermissionTo($permissions);
        $managerRole->givePermissionTo(['view company data']);
    }
}
