<?php

namespace Database\Factories;

use App\Models\Process;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Process>
 */
class ProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['workflow', 'information']);
        $data = [
            'company_id' => Company::factory(),
            'name' => $this->faker->word() . ' Process',
            'description' => $this->faker->sentence(50),
            'type' => $type,
        ];

        if ($type === 'workflow') {
            $data['workflow_data'] = collect(range(1, 3))->map(function () {
                return [
                    'title' => $this->faker->sentence(),
                    'description' => $this->faker->paragraph(),
                    'image' => null
                ];
            })->toArray();
        } else {
            $data['information_data'] = collect(range(1, 3))->map(function () {
                return [
                    'title' => $this->faker->sentence(),
                    'information' => $this->faker->paragraph(),
                    'has_schedule' => $this->faker->boolean(),
                    'schedule_title' => $this->faker->sentence(),
                    'schedule_text' => $this->faker->paragraph(),
                    'has_image' => $this->faker->boolean(),
                    'image' => null
                ];
            })->toArray();
        }

        return $data;
    }
}