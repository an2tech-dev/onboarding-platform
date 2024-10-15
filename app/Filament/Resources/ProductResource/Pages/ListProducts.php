<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if (auth()->user()->hasRole('Manager')) {
            return $query->where('company_id', auth()->user()->company_id);
        }

        return $query; 
    }

    protected function getActions(): array
    {
        if (auth()->user()->hasRole('Administrator')) {
            return [
                \Filament\Pages\Actions\CreateAction::make(),
            ];
        }

        return []; 
    }
}