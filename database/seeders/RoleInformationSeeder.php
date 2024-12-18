<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\RoleInformation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all companies
        $companies = Company::all();

        foreach ($companies as $company) {
            RoleInformation::factory()->count(3)->create([
                'company_id' => $company->id,
            ]);
        }

    }
}
