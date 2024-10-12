<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function canEdit($record): bool
    {
        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        return auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->company_id;
    }
}