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
        Company::all()->each(function ($company) {
            Team::factory(5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}