<?php

namespace App\Filament\Resources;

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
use App\Filament\Resources\FloorResource\Pages;

class FloorResource extends Resource
{
    protected static ?string $model = Floor::class;

    protected static ?string $navigationLabel = 'Floors';
    protected static ?string $navigationIcon = 'heroicon-o-home'; 

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
               (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->company_id);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator') || 
               (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->company_id);
    }

    public static function form(Form $form): Form
    {
        $schema = [];

        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Select::make('company_id')
                ->relationship('company', 'name')
                ->required()
                ->label('Company');
        } else {
            $schema[] = Select::make('company_id')
                ->options([
                    auth()->user()->company_id => auth()->user()->company->name 
                ])
                ->required()
                ->label('Company')
                ->default(auth()->user()->company_id); 
        }

        $schema[] = TextInput::make('name')
            ->required()
            ->label('Floor Name');

        $schema[] = TextInput::make('floor_number')
            ->numeric()
            ->required()
            ->label('Floor Number');

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('company.name')->label('Company')->sortable(),
                TextColumn::make('name')->label('Floor Name')->sortable(),
                TextColumn::make('floor_number')->label('Floor Number')->sortable(),
                // TextColumn::make('created_at')->label('Created At')->dateTime(),
                // TextColumn::make('updated_at')->label('Updated At')->dateTime(),
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

        return parent::getEloquentQuery()->where('company_id', auth()->user()->company_id);
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