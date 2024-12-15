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
        $predefinedResources = [
            [
                'categories' => 'Training Materials',
                'title' => 'New Employee Onboarding Guide',
                'description' => 'Comprehensive guide for onboarding new team members',
                'url' => 'https://company-resources.com/onboarding-guide',
            ],
            [
                'categories' => 'Technical Documentation',
                'title' => 'API Integration Manual',
                'description' => 'Complete documentation for system API integration',
                'url' => 'https://company-resources.com/api-manual',
            ],
            [
                'categories' => 'HR Documents',
                'title' => 'Employee Handbook 2024',
                'description' => 'Updated company policies and procedures',
                'url' => 'https://company-resources.com/handbook-2024',
            ]
        ];

        Company::all()->each(function ($company) use ($predefinedResources) {
            foreach ($predefinedResources as $resource) {
                Resource::firstOrCreate(
                    [
                        'title' => $resource['title'],
                        'company_id' => $company->id
                    ],
                    array_merge($resource, ['company_id' => $company->id])
                );
            }
            
            // Create additional random resources if needed
            $resourceCount = Resource::where('company_id', $company->id)->count();
            if ($resourceCount < 6) { // 3 predefined + 3 random
                Resource::factory(6 - $resourceCount)->create([
                    'company_id' => $company->id,
                ]);
            }
        });
    }
}