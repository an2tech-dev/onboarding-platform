<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Company;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::all()->each(function ($company) {
            $standardTeams = [
                [
                    'name' => 'Engineering Team',
                    'description' => 'Core development and technical implementation team',
                ],
                [
                    'name' => 'Product Team',
                    'description' => 'Product strategy and management team',
                ],
                [
                    'name' => 'Marketing Team',
                    'description' => 'Marketing and brand management team',
                ],
                [
                    'name' => 'HR Team',
                    'description' => 'Human resources and personnel management',
                ],
                [
                    'name' => 'Sales Team',
                    'description' => 'Sales and business development',
                ]
            ];

            foreach ($standardTeams as $team) {
                Team::create([
                    'company_id' => $company->id,
                    ...$team
                ]);
            }

            Team::factory(2)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}