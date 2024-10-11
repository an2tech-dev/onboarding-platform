<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            if (auth()->check() && auth()->user()->hasRole('Employee')) {
                // Block Employees from accessing the dashboard and show the 403 page
                abort(403, 'You do not have access to this page.');
            }
        });
    }
}