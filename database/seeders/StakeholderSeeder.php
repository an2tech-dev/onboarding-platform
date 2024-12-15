<?php

namespace Database\Seeders;

use App\Models\Stakeholder;
use App\Models\Company;
use Illuminate\Database\Seeder;

class StakeholderSeeder extends Seeder
{
    public function run(): void
    {
        $predefinedStakeholders = [
            [
                'name' => 'John Smith',
                'role' => 'Lead Investor',
            ],
            [
                'name' => 'Sarah Johnson',
                'role' => 'Strategic Partner',
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Technical Advisor',
            ],
            [
                'name' => 'Emma Williams',
                'role' => 'Board Member',
            ],
            [
                'name' => 'David Miller',
                'role' => 'Financial Advisor',
            ]
        ];

        Company::all()->each(function ($company) use ($predefinedStakeholders) {
            foreach ($predefinedStakeholders as $stakeholder) {
                Stakeholder::firstOrCreate(
                    [
                        'name' => $stakeholder['name'],
                        'company_id' => $company->id
                    ],
                    array_merge($stakeholder, ['company_id' => $company->id])
                );
            }
            
            // Create additional random stakeholders if needed
            $stakeholderCount = Stakeholder::where('company_id', $company->id)->count();
            if ($stakeholderCount < 8) { // 5 predefined + 3 random
                Stakeholder::factory(8 - $stakeholderCount)->create([
                    'company_id' => $company->id,
                ]);
            }
        });
    }
}