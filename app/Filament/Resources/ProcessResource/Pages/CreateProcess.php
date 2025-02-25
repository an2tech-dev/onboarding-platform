<?php

namespace App\Filament\Resources\ProcessResource\Pages;

use App\Filament\Resources\ProcessResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProcess extends CreateRecord
{
    protected static string $resource = ProcessResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()->hasRole('Manager')) {
            $data['company_id'] = auth()->user()->company_id;
        }
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
