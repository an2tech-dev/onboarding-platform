<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Company;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $predefinedTeams = [
            ['name' => 'Software Development'],
            ['name' => 'Quality Assurance'],
            ['name' => 'Product Management'],
            ['name' => 'Customer Support'],
            ['name' => 'Marketing'],
        ];

        Company::all()->each(function ($company) use ($predefinedTeams) {
            foreach ($predefinedTeams as $team) {
                Team::firstOrCreate(
                    [
                        'name' => $team['name'],
                        'company_id' => $company->id
                    ],
                    $team
                );
            }
            
            // Create additional random teams if needed
            $teamCount = Team::where('company_id', $company->id)->count();
            if ($teamCount < 7) { // 5 predefined + 2 random
                Team::factory(7 - $teamCount)->create([
                    'company_id' => $company->id,
                ]);
            }
        });
    }
}