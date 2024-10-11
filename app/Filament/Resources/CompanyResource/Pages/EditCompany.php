<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function canEdit($record): bool
    {
        return auth()->user()->hasRole('Administrator') || 
               (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->id);
    }
}