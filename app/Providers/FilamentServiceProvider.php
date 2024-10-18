<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\CompanyResource; // Import the CompanyResource

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            // Block Employees from accessing the dashboard and show the 403 page
            if (auth()->check() && auth()->user()->hasRole('Employee')) {
                abort(403, 'You do not have access to this page.');
            }
        });

        // Register the CompanyResource and other Filament resources
        Filament::registerResources([
            CompanyResource::class,
            // Add other resources here as needed (e.g., TeamResource, FloorResource, etc.)
        ]);
    }
}