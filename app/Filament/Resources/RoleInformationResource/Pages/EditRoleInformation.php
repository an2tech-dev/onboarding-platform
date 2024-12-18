<?php

namespace App\Filament\Resources\RoleInformationResource\Pages;

use App\Filament\Resources\RoleInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoleInformation extends EditRecord
{
    protected static string $resource = RoleInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 