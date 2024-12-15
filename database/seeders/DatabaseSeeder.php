<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // First seed roles and permissions
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Then seed companies and all related data
        $this->seedCompaniesAndRelatedData();
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
            ScheduleSeeder::class,
            StakeholderSeeder::class,
            UserSeeder::class,
        ]);
    }
}
