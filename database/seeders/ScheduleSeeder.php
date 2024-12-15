<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use App\Models\Process;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Process::all()->each(function ($process) {
            Schedule::factory(5)->create([
                'process_id' => $process->id,
            ]);
        });
    }
}