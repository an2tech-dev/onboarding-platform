<?php


namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions\CreateAction;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getTableQuery(): ?Builder
    {
        if (auth()->user()->hasRole('Manager')) {
            return parent::getTableQuery()->where('id', auth()->user()->company_id);
        }

        return parent::getTableQuery();
    }

    protected function getActions(): array
    {
        if (auth()->user()->hasRole('Administrator')) {
            return [
                CreateAction::make(),
            ];
        }

        return [];
    }
}