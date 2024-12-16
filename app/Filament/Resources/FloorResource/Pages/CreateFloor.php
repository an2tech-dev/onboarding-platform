<?php

namespace App\Filament\Resources\FloorResource\Pages;

use App\Filament\Resources\FloorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFloor extends CreateRecord
{
    protected static string $resource = FloorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()->hasRole('Manager')) {
            $data['company_id'] = auth()->user()->company_id;
        }
        
        return $data;
    }
}
