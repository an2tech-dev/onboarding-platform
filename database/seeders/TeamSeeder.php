<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Company;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create teams for existing companies
        Company::all()->each(function ($company) {
            Team::factory(3)->create([
                'company_id' => $company->id,
            ]);
        });

        Team::factory(5)->create();
    }
}