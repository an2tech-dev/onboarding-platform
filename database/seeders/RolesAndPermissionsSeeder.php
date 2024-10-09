<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'Administrator']);
        $manager = Role::create(['name' => 'Manager']);
        $employee = Role::create(['name' => 'Employee']);

        Permission::create(['name' => 'manage all companies']);
        Permission::create(['name' => 'manage own company']);
        Permission::create(['name' => 'view own company data']);

        $admin->givePermissionTo(['manage all companies', 'manage own company', 'view own company data']);
        $manager->givePermissionTo(['manage own company', 'view own company data']);
    }
}
