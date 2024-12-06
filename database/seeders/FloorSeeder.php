<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Company;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Floor::factory(5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}