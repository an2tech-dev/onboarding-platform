<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $predefinedSchedules = [
            [
                'schedule_type' => 'Meeting',
                'title' => 'Weekly Team Sync',
                'description' => 'Regular team sync to discuss progress and blockers',
                'start_time' => Carbon::now()->addDays(1)->setHour(10)->setMinute(0),
                'end_time' => Carbon::now()->addDays(1)->setHour(11)->setMinute(0),
            ],
            [
                'schedule_type' => 'Event',
                'title' => 'Company Town Hall',
                'description' => 'Monthly company-wide meeting to discuss updates and achievements',
                'start_time' => Carbon::now()->addDays(7)->setHour(14)->setMinute(0),
                'end_time' => Carbon::now()->addDays(7)->setHour(16)->setMinute(0),
            ],
            [
                'schedule_type' => 'Deadline',
                'title' => 'Q4 Report Submission',
                'description' => 'Deadline for submitting Q4 performance reports',
                'start_time' => Carbon::now()->addDays(14)->setHour(9)->setMinute(0),
                'end_time' => Carbon::now()->addDays(14)->setHour(17)->setMinute(0),
            ],
            [
                'schedule_type' => 'Reminder',
                'title' => 'Software License Renewal',
                'description' => 'Reminder to renew enterprise software licenses',
                'start_time' => Carbon::now()->addDays(30)->setHour(9)->setMinute(0),
                'end_time' => Carbon::now()->addDays(30)->setHour(10)->setMinute(0),
            ]
        ];

        Company::all()->each(function ($company) use ($predefinedSchedules) {
            foreach ($predefinedSchedules as $schedule) {
                Schedule::create(array_merge($schedule, ['company_id' => $company->id]));
            }
            
            Schedule::factory(3)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}