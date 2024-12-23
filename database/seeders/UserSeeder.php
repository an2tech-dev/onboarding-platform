<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Team;
use App\Models\RoleInformation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $mainAdmin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $mainAdmin->assignRole('Administrator');

        Company::all()->each(function ($company) {
            $companyTeams = Team::where('company_id', $company->id)->get();
            $roleInfos = RoleInformation::where('company_id', $company->id)->get();
            
            for ($i = 1; $i <= 2; $i++) {
                $manager = User::create([
                    'name' => fake()->name(),
                    'email' => "manager_{$company->id}_{$i}@company.test",
                    'password' => Hash::make('password'),
                    'company_id' => $company->id,
                    'team_id' => $companyTeams->random()->id,
                    'role_information_id' => $roleInfos->where('title', 'like', '%Manager%')->first()->id ?? $roleInfos->random()->id
                ]);
                $manager->assignRole('Manager');
            }

            $employeeCount = rand(5, 7);
            for ($i = 1; $i <= $employeeCount; $i++) {
                $employee = User::create([
                    'name' => fake()->name(),
                    'email' => "employee_{$company->id}_{$i}@company.test",
                    'password' => Hash::make('password'),
                    'company_id' => $company->id,
                    'team_id' => $companyTeams->random()->id,
                    'role_information_id' => $roleInfos->where('title', 'like', '%Engineer%')->first()->id ?? $roleInfos->random()->id
                ]);
                $employee->assignRole('Employee');
            }
        });
    }
}