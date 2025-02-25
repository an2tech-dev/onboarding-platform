<?php

namespace App\Filament\Resources\RoleInformationResource\Pages;

use App\Filament\Resources\RoleInformationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRoleInformation extends CreateRecord
{
    protected static string $resource = RoleInformationResource::class;

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