<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Team;
use Filament\Tables;
use App\Models\Company;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeamResource\Pages;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationLabel = 'Teams';
    protected static ?string $navigationIcon = 'heroicon-o-users'; 
    protected static ?string $navigationGroup = 'General';

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
                ->label('Company')
                ->searchable()
                ->live()
                ->afterStateUpdated(fn ($state, callable $set) => $set('products', []));
        }

        $schema[] = TextInput::make('name')
            ->required()
            ->label('Team Name')
            ->placeholder('Enter team name');
        
        $schema[] = Textarea::make('description')
            ->label('Description')
            ->placeholder('Enter team description (optional)');

        $schema[] = Select::make('products')
            ->multiple()
            ->relationship(
                'products',
                'name',
                function (Builder $query, $get) {
                    if (auth()->user()->hasRole('Administrator')) {
                        $companyId = $get('company_id');
                        return $query->when(
                            $companyId,
                            fn ($q) => $q->where('company_id', $companyId)
                        );
                    }
                    return $query->where('company_id', auth()->user()->company_id);
                }
            )
            ->preload()
            ->searchable();

        $schema[] = FileUpload::make('image')
            ->image()
            ->directory('team-images')
            ->visibility('public')
            ->maxSize(5120)
            ->columnSpanFull()
            ->preserveFilenames()
            ->downloadable()
            ->openable();

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('company.name')->label('Company')->sortable()->searchable(),
                TextColumn::make('name')->label('Team Name')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([]);
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('Administrator')) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()
            ->where('company_id', auth()->user()->company_id);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()->hasRole('Manager')) {
            $data['company_id'] = auth()->user()->company_id;
        }
        
        return $data;
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