<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'schedule_type' => $this->faker->randomElement(['Meeting', 'Deadline', 'Event', 'Reminder']),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
        ];
    }
}