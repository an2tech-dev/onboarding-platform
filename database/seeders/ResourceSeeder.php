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
            $standardResources = [
                [
                    'categories' => 'Documentation, Guides',
                    'title' => 'Employee Handbook',
                    'description' => 'Comprehensive guide for all company policies and procedures',
                    'url' => 'https://company-resources.test/handbook',
                ],
                [
                    'categories' => 'Training, Development',
                    'title' => 'Technical Training Materials',
                    'description' => 'Collection of technical training resources and tutorials',
                    'url' => 'https://company-resources.test/training',
                ],
                [
                    'categories' => 'HR, Benefits',
                    'title' => 'Benefits Guide',
                    'description' => 'Detailed information about employee benefits and programs',
                    'url' => 'https://company-resources.test/benefits',
                ],
                [
                    'categories' => 'Security, Compliance',
                    'title' => 'Security Guidelines',
                    'description' => 'Security best practices and compliance requirements',
                    'url' => 'https://company-resources.test/security',
                ],
                [
                    'categories' => 'Project Management',
                    'title' => 'Project Templates',
                    'description' => 'Standard templates for project documentation',
                    'url' => 'https://company-resources.test/templates',
                ]
            ];

            foreach ($standardResources as $resource) {
                Resource::create([
                    'company_id' => $company->id,
                    ...$resource
                ]);
            }

            Resource::factory(2)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}