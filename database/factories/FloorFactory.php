<?php

namespace Database\Factories;

use App\Models\Floor;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Floor>
 */
class FloorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['Office Floor', 'Other Activities']);
        
        return [
            'company_id' => Company::factory(),
            'name' => $this->faker->word() . ' Floor',
            'floor_number' => $this->faker->numberBetween(1, 30),
            'type' => $type,
            'image' => $type === 'Other Activities' ? $this->faker->imageUrl() : null,
        ];
    }
}