<?php

namespace Database\Seeders;

use App\Models\Process;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Process::factory(3)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}