<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcessesResource\Pages;
use App\Models\Processes;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProcessesResource extends Resource
{
    protected static ?string $model = Processes::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('Process Name'),
                Textarea::make('description')->required()->label('Description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Process Name'),
                Tables\Columns\TextColumn::make('description')->label('Description'),
            ])
            ->filters([
                
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProcesses::route('/'),
            'create' => Pages\CreateProcesses::route('/create'),
            'edit' => Pages\EditProcesses::route('/{record}/edit'),
        ];
    }
}
