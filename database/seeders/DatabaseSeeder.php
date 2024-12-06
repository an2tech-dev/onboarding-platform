<?php

namespace Database\Seeders;

use App\Models\Team;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Company;
use App\Models\Stakeholder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedRolesAndAdmins();
        $admin = User::factory()->admin()->create();
        $admin->assignRole('Administrator');
    }

    /**
     * Seed roles and admin-related data.
     */
    private function seedRolesAndAdmins(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            AdminSeeder::class,
        ]);
    }

    /**
     * Seed companies and related data.
     */
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
        ]);
    }
}
