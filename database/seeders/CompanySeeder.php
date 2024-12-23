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
                'office_size' => 2500,
                'benefits' => ['Health Insurance', 'Dental Coverage', 'Flexible Hours', '401k Match']
            ],
            [
                'name' => 'InnovateTech',
                'description' => 'Innovative technology solutions for modern businesses',
                'established' => '2015-06-22',
                'office_size' => 1200,
                'benefits' => ['Health Insurance', 'Remote Work', 'Professional Development']
            ],
            [
                'name' => 'Digital Dynamics',
                'description' => 'Digital transformation and consulting services',
                'established' => '2018-01-10',
                'office_size' => 800,
                'benefits' => ['Health Insurance', 'Stock Options', 'Flexible Hours']
            ],
            [
                'name' => 'CloudNet Systems',
                'description' => 'Cloud infrastructure and networking solutions',
                'established' => '2012-09-15',
                'office_size' => 1500,
                'benefits' => ['Health Insurance', 'Performance Bonus', 'Remote Work']
            ],
            [
                'name' => 'DataFlow Analytics',
                'description' => 'Data analytics and business intelligence solutions',
                'established' => '2016-03-28',
                'office_size' => 1000,
                'benefits' => ['Health Insurance', 'Education Allowance', 'Gym Membership']
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}