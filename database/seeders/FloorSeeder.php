<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Company;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    public function run(): void
    {
        $predefinedFloors = [
            [
                'name' => 'Executive Suite',
                'floor_number' => 20,
            ],
            [
                'name' => 'Development Center',
                'floor_number' => 15,
            ],
            [
                'name' => 'Innovation Lab',
                'floor_number' => 16,
            ],
            [
                'name' => 'Conference Center',
                'floor_number' => 2,
            ],
            [
                'name' => 'Collaboration Space',
                'floor_number' => 10,
            ]
        ];

        Company::all()->each(function ($company) use ($predefinedFloors) {
            foreach ($predefinedFloors as $floor) {
                Floor::firstOrCreate(
                    [
                        'name' => $floor['name'],
                        'company_id' => $company->id
                    ],
                    array_merge($floor, ['company_id' => $company->id])
                );
            }
            
            // Create additional random floors if needed
            $floorCount = Floor::where('company_id', $company->id)->count();
            if ($floorCount < 7) { // 5 predefined + 2 random
                Floor::factory(7 - $floorCount)->create([
                    'company_id' => $company->id,
                ]);
            }
        });
    }
}