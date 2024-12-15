<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name' => 'TechCorp Solutions',
                'description' => 'Leading provider of enterprise software solutions',
                'established' => '2010-03-15',
                'team_members' => 250,
                'office_size' => 2500,
                'floors' => 3,
                'benefits' => ['Health Insurance', 'Dental Care', '401k', 'Gym Membership', 'Remote Work'],
            ],
            [
                'name' => 'InnovateTech Industries',
                'description' => 'Innovative technology solutions for modern businesses',
                'established' => '2015-06-22',
                'team_members' => 150,
                'office_size' => 1800,
                'floors' => 2,
                'benefits' => ['Health Insurance', 'Stock Options', 'Flexible Hours', 'Professional Development'],
            ],
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate(
                ['name' => $company['name']],
                $company
            );
        }

        // Create additional random companies only if we have less than 10 companies
        $companyCount = Company::count();
        if ($companyCount < 10) {
            Company::factory(10 - $companyCount)->create();
        }
    }
}