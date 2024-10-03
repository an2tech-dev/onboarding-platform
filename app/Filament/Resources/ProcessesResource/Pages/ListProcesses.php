<?php

namespace App\Filament\Resources\ProcessesResource\Pages;

use App\Filament\Resources\ProcessesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProcesses extends ListRecords
{
    protected static string $resource = ProcessesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
