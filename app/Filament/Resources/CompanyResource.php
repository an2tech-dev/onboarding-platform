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
use Filament\Forms\Components\Select;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationLabel = 'Companies';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Settings';

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

                TextInput::make('office_size')
                    ->label('Office Size (sqft)')
                    ->numeric()
                    ->minValue(1)
                    ->nullable(),

                Select::make('benefits')
                    ->multiple()
                    ->options([
                        'Health Insurance' => 'Health Insurance',
                        'Paid Time Off' => 'Paid Time Off',
                        'Flexible Hours' => 'Flexible Hours',
                        'Gym Membership' => 'Gym Membership',
                        'Retirement Plan' => 'Retirement Plan',
                        'Remote Work' => 'Remote Work',
                        'Professional Development' => 'Professional Development'
                    ])
                    ->searchable()
                    ->preload()
                    ->nullable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->label('Company Name')->sortable()->searchable(),
                TextColumn::make('description')->label('Description')->limit(50)->searchable(),
                TextColumn::make('established')->label('Established')->date()->searchable(),
                TextColumn::make('office_size')->label('Office Size (sqft)')->sortable()->searchable(),
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