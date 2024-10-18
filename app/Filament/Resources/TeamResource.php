<?php

namespace App\Filament\Resources;

use App\Models\Team;
use App\Models\Floor;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\TeamResource\Pages;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationLabel = 'Teams';
    protected static ?string $navigationIcon = 'heroicon-o-users'; 

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('Administrator') || auth()->user()->hasRole('Manager');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('Administrator') || auth()->user()->hasRole('Manager');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator') || 
               (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->floor->company_id);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator') || 
               (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->floor->company_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('floor_id')
                    ->relationship('floor', 'name')
                    ->required()
                    ->label('Floor'),

                TextInput::make('name')
                    ->required()
                    ->label('Team Name'),

                TextInput::make('members_count')
                    ->numeric()
                    ->required()
                    ->label('Number of Members'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('floor.name')->label('Floor')->sortable(),
                TextColumn::make('name')->label('Team Name')->sortable(),
                TextColumn::make('members_count')->label('Members Count')->sortable(),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
                TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('Administrator')) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->whereHas('floor', function (Builder $query) {
            $query->where('company_id', auth()->user()->company_id);
        });
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