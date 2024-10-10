<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'manage companies']);
        Permission::create(['name' => 'view company data']);

        $admin = Role::create(['name' => 'Administrator']);
        $manager = Role::create(['name' => 'Manager']);
        $employee = Role::create(['name' => 'Employee']);

        $admin->givePermissionTo('manage companies');
        $manager->givePermissionTo('view company data');
    }
}
