<?php

namespace Database\Seeders;

use App\Models\Stakeholder;
use App\Models\Company;
use Illuminate\Database\Seeder;

class StakeholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Stakeholder::factory(5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}