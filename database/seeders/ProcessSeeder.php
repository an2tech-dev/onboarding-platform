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
        $predefinedProcesses = [
            [
                'name' => 'Product Development Lifecycle',
                'description' => 'Comprehensive process for developing and launching new products, including planning, design, implementation, testing, and deployment phases.',
            ],
            [
                'name' => 'Customer Onboarding',
                'description' => 'Structured approach to welcoming and integrating new customers, including account setup, initial training, and support procedures.',
            ],
            [
                'name' => 'Quality Assurance Protocol',
                'description' => 'Systematic process for ensuring product quality through various testing phases, code reviews, and validation procedures.',
            ],
            [
                'name' => 'Employee Training Program',
                'description' => 'Standardized process for training new employees and updating existing staff on new technologies and procedures.',
            ]
        ];

        Company::all()->each(function ($company) use ($predefinedProcesses) {
            foreach ($predefinedProcesses as $process) {
                Process::firstOrCreate(
                    [
                        'name' => $process['name'],
                        'company_id' => $company->id
                    ],
                    array_merge($process, ['company_id' => $company->id])
                );
            }
            
            // Create additional random processes if needed
            $processCount = Process::where('company_id', $company->id)->count();
            if ($processCount < 6) { // 4 predefined + 2 random
                Process::factory(6 - $processCount)->create([
                    'company_id' => $company->id,
                ]);
            }
        });
    }
}