<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedRolesAndAdmins();
        $this->seedCompaniesAndRelatedData();
        $this->seedUsers();
    }

    private function seedRolesAndAdmins(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);
    }

    private function seedCompaniesAndRelatedData(): void
    {
        $this->call([
            CompanySeeder::class,
            TeamSeeder::class,
            FloorSeeder::class,
            ProcessSeeder::class,
            ProductSeeder::class,
            ResourceSeeder::class,
            StakeholderSeeder::class,
            RoleInformationSeeder::class,
        ]);
    }

    private function seedUsers(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
    }
}
