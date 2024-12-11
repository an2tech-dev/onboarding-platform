<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Product::factory(5)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}