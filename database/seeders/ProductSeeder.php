<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $predefinedProducts = [
            [
                'name' => 'Enterprise CRM Suite',
                'description' => 'Comprehensive customer relationship management system with advanced analytics',
                'release_date' => '2023-01-15',
                'product_image' => 'https://example.com/images/crm-suite.jpg',
            ],
            [
                'name' => 'CloudSync Pro',
                'description' => 'Cloud-based data synchronization and backup solution for businesses',
                'release_date' => '2023-03-22',
                'product_image' => 'https://example.com/images/cloudsync.jpg',
            ],
            [
                'name' => 'SecureGate Firewall',
                'description' => 'Next-generation firewall with AI-powered threat detection',
                'release_date' => '2023-06-10',
                'product_image' => 'https://example.com/images/securegate.jpg',
            ]
        ];

        Company::all()->each(function ($company) use ($predefinedProducts) {
            foreach ($predefinedProducts as $product) {
                Product::firstOrCreate(
                    [
                        'name' => $product['name'],
                        'company_id' => $company->id
                    ],
                    array_merge($product, ['company_id' => $company->id])
                );
            }
            
            // Create additional random products if needed
            $productCount = Product::where('company_id', $company->id)->count();
            if ($productCount < 6) { // 3 predefined + 3 random
                Product::factory(6 - $productCount)->create([
                    'company_id' => $company->id,
                ]);
            }
        });
    }
}