<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Schedule::factory(5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}