<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
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
            'categories' => $this->faker->words(3, true),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'url' => $this->faker->url(),
        ];
    }
}