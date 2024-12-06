<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Resource::factory(5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}