<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Company;
use App\Models\Team;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            $standardProducts = [
                [
                    'name' => 'Enterprise Suite',
                    'description' => 'Complete business management solution with integrated modules for HR, Finance, and Operations',
                    'release_date' => '2023-01-15',
                ],
                [
                    'name' => 'Mobile Platform',
                    'description' => 'Cross-platform mobile application development framework',
                    'release_date' => '2023-06-22',
                ],
                [
                    'name' => 'Analytics Dashboard',
                    'description' => 'Real-time business analytics and reporting platform',
                    'release_date' => '2023-03-10',
                ],
                [
                    'name' => 'Cloud Security Suite',
                    'description' => 'Comprehensive cloud security and compliance solution',
                    'release_date' => '2023-08-30',
                ]
            ];

            foreach ($standardProducts as $product) {
                $newProduct = Product::create([
                    'company_id' => $company->id,
                    ...$product
                ]);

                $teams = Team::where('company_id', $company->id)
                    ->inRandomOrder()
                    ->take(rand(2, 3))
                    ->get();
                
                $newProduct->teams()->attach($teams->pluck('id'));
            }

            Product::factory(2)->create([
                'company_id' => $company->id,
            ])->each(function ($product) use ($company) {
                $teams = Team::where('company_id', $company->id)
                    ->inRandomOrder()
                    ->take(rand(1, 2))
                    ->get();
                $product->teams()->attach($teams->pluck('id'));
            });
        });
    }
}