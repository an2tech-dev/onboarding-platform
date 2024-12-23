<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            StakeholderSeeder::class,
            RoleInformationSeeder::class,
        ]);
    }
}
