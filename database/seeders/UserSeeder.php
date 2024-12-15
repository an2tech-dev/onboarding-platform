<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Administrator');

        // Create users for each company
        Company::all()->each(function ($company) {
            // Create a manager for each company if doesn't exist
            $managerEmail = 'manager.' . $company->id . '@' . strtolower(str_replace(' ', '', $company->name)) . '.com';
            $manager = User::firstOrCreate(
                ['email' => $managerEmail],
                [
                    'name' => fake()->name(),
                    'password' => Hash::make('password'),
                    'company_id' => $company->id,
                ]
            );
            $manager->assignRole('Manager');

            // Create 5 employees for each company
            for ($i = 0; $i < 5; $i++) {
                $employee = User::create([
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'company_id' => $company->id,
                    'team_id' => Team::where('company_id', $company->id)->inRandomOrder()->first()->id,
                ]);
                $employee->assignRole('Employee');
            }
        });

        // Create additional administrators if they don't exist
        for ($i = 1; $i <= 2; $i++) {
            $adminEmail = 'admin' . $i . '@admin.com';
            $admin = User::firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => fake()->name(),
                    'password' => Hash::make('password'),
                ]
            );
            $admin->assignRole('Administrator');
        }
    }
} 