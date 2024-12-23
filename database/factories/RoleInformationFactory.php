<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoleInformation>
 */
class RoleInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'expectations' => $this->faker->paragraphs(2, true),
            'overview' => $this->faker->paragraphs(3, true),
            'company_id' => Company::factory(), 
        ];
    }
}
