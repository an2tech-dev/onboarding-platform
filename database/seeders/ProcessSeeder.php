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
            // Workflow processes
            $workflowProcesses = [
                [
                    'name' => 'New Employee Onboarding',
                    'description' => 'Standard process for onboarding new employees',
                    'type' => 'workflow',
                    'workflow_data' => [
                        ['title' => 'Documentation Collection', 'description' => 'Collect necessary documents'],
                        ['title' => 'System Setup', 'description' => 'Set up employee accounts'],
                        ['title' => 'Training Schedule', 'description' => 'Complete required training']
                    ]
                ],
                [
                    'name' => 'Project Kickoff',
                    'description' => 'Standard process for starting new projects',
                    'type' => 'workflow',
                    'workflow_data' => [
                        ['title' => 'Requirements Gathering', 'description' => 'Collect project requirements'],
                        ['title' => 'Team Assembly', 'description' => 'Assign team members'],
                        ['title' => 'Initial Planning', 'description' => 'Create project timeline']
                    ]
                ],
                [
                    'name' => 'Client Onboarding',
                    'description' => 'Process for onboarding new clients',
                    'type' => 'workflow',
                    'workflow_data' => [
                        ['title' => 'Initial Consultation', 'description' => 'Gather client requirements'],
                        ['title' => 'Contract Setup', 'description' => 'Prepare and sign agreements'],
                        ['title' => 'Resource Allocation', 'description' => 'Assign team and resources']
                    ]
                ]
            ];

            // Information processes
            $infoProcesses = [
                [
                    'name' => 'Company Policies',
                    'description' => 'Important company policies and procedures',
                    'type' => 'information',
                    'information_data' => [
                        [
                            'title' => 'Work Hours',
                            'information' => '9 AM to 5 PM, Monday to Friday',
                            'has_schedule' => true,
                            'schedule_title' => 'Office Hours',
                            'schedule_text' => 'Standard working hours with flexible options'
                        ],
                        [
                            'title' => 'Remote Work Policy',
                            'information' => 'Hybrid work model with 2 days in office',
                            'has_schedule' => false
                        ]
                    ]
                ]
            ];

            foreach ($workflowProcesses as $process) {
                Process::create([
                    'company_id' => $company->id,
                    ...$process
                ]);
            }

            foreach ($infoProcesses as $process) {
                Process::create([
                    'company_id' => $company->id,
                    ...$process
                ]);
            }
        });
    }
}