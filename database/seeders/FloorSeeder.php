<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Company;
use App\Models\Team;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            // Create standard floors for each company
            $standardFloors = [
                [
                    'name' => 'Main Office Floor',
                    'floor_number' => 1,
                    'type' => 'Office Floor',
                ],
                [
                    'name' => 'Conference Level',
                    'floor_number' => 2,
                    'type' => 'Office Floor',
                ],
                [
                    'name' => 'Recreation Area',
                    'floor_number' => 3,
                    'type' => 'Other Activities',
                    'image' => 'https://example.com/recreation.jpg'
                ],
                [
                    'name' => 'Innovation Lab',
                    'floor_number' => 4,
                    'type' => 'Other Activities',
                ],
            ];

            foreach ($standardFloors as $floor) {
                $newFloor = Floor::create([
                    'company_id' => $company->id,
                    ...$floor
                ]);

                $teams = Team::where('company_id', $company->id)
                    ->inRandomOrder()
                    ->take(2)
                    ->get();
                
                $newFloor->teams()->attach($teams->pluck('id'));
            }

            Floor::factory(2)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}