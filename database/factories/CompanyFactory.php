<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence(10),
            'established' => $this->faker->date('Y-m-d', 'now'),
            'office_size' => $this->faker->numberBetween(50, 5000),
            'benefits' => json_encode($this->faker->randomElements(
                ['Health Insurance', 'Paid Time Off', 'Flexible Hours', 'Gym Membership', 'Retirement Plan'],
                $this->faker->numberBetween(1, 5)
            )),
        ];
    }
}