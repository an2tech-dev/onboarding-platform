<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FloorResource\Pages;
use App\Models\Floor;
use App\Models\Company; 
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class FloorResource extends Resource
{
    protected static ?string $model = Floor::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('company_id')
                    ->relationship('company', 'name') 
                    ->required(), 
                TextInput::make('name')->required(),
                TextInput::make('floor_number')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')->label('Company'), 
                Tables\Columns\TextColumn::make('name')->label('Floor Name'),
                Tables\Columns\TextColumn::make('floor_number')->label('Floor Number'),
            ])
            ->filters([
               
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFloors::route('/'),
            'create' => Pages\CreateFloor::route('/create'),
            'edit' => Pages\EditFloor::route('/{record}/edit'),
        ];
    }
}