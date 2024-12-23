<?php

namespace Database\Seeders;

use App\Models\Stakeholder;
use App\Models\Company;
use Illuminate\Database\Seeder;

class StakeholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            $standardStakeholders = [
                [
                    'name' => 'John Anderson',
                    'role' => 'CEO',
                ],
                [
                    'name' => 'Sarah Mitchell',
                    'role' => 'Lead Investor',
                ],
                [
                    'name' => 'Michael Chen',
                    'role' => 'Strategic Partner',
                ],
                [
                    'name' => 'Emily Rodriguez',
                    'role' => 'Board Member',
                ],
            ];

            foreach ($standardStakeholders as $stakeholder) {
                Stakeholder::create([
                    'company_id' => $company->id,
                    ...$stakeholder,
                ]);
            }

            Stakeholder::factory(3)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}