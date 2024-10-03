<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('floor_id')
                    ->relationship('floor', 'name')
                    ->required(),
                TextInput::make('name')->required(),
                TextInput::make('members_count')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('floor.name')->label('Floor'),
                Tables\Columns\TextColumn::make('name')->label('Team Name'),
                Tables\Columns\TextColumn::make('members_count')->label('Members Count'),
            ])
            ->filters([
         
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
