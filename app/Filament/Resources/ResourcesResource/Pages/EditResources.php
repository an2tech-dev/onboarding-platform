<?php

namespace App\Filament\Resources\ResourcesResource\Pages;

use App\Filament\Resources\ResourcesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResources extends EditRecord
{
    protected static string $resource = ResourcesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
