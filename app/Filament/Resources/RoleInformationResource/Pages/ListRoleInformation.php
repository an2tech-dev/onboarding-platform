<?php

namespace App\Filament\Resources\RoleInformationResource\Pages;

use App\Filament\Resources\RoleInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoleInformation extends ListRecords
{
    protected static string $resource = RoleInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 