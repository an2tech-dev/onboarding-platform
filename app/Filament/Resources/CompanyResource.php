<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Company;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CompanyResource\Pages; 

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationLabel = 'Companies';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('Administrator') || auth()->user()->hasRole('Manager');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('Administrator');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator') || 
               (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $record->id);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Company Name'),

                Textarea::make('description')
                    ->label('Company Description')
                    ->nullable(),

                DatePicker::make('established')
                    ->label('Established Date')
                    ->nullable()
                    ->displayFormat('Y-m-d'),

                TextInput::make('team_members')
                    ->label('Number of Team Members')
                    ->numeric()
                    ->minValue(1)
                    ->nullable(),

                TextInput::make('office_size')
                    ->label('Office Size (sqft)')
                    ->numeric()
                    ->minValue(1)
                    ->nullable(),

                TextInput::make('floors')
                    ->label('Floors')
                    ->nullable(),
                Repeater::make('benefits')
                ->label('Benefits')
                ->schema([
                    TextInput::make('benefit')
                        ->label('Benefit')
                        ->required(),
                ])
                ->columns(1)
                ->nullable()
                ->afterStateHydrated(function ($state, $set) {
                    // Convert flat array of strings to objects for display in Repeater
                    if (is_array($state)) {
                        $set('benefits', collect($state)->map(fn ($benefit) => ['benefit' => $benefit])->toArray());
                    }
                })
                ->mutateDehydratedStateUsing(function ($state) {
                    // Convert array of objects back to flat array of strings for storage
                    return collect($state)->pluck('benefit')->toArray();
                })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->label('Company Name')->sortable(),
                TextColumn::make('description')->label('Description')->limit(50),
                TextColumn::make('established')->label('Established')->date(),
                TextColumn::make('team_members')->label('Team Members')->sortable(),
                TextColumn::make('office_size')->label('Office Size (sqft)')->sortable(),
                TextColumn::make('floors')->label('Floors')->limit(50), 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
            
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('Administrator')) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->where('id', auth()->user()->company_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}