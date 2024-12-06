<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => $this->faker->word() . ' Product',
            'description' => $this->faker->sentence(20),
            'release_date' => $this->faker->date('Y-m-d', 'now'),
            'product_image' => $this->faker->imageUrl(640, 480, 'product', true, 'Faker'),
        ];
    }
}