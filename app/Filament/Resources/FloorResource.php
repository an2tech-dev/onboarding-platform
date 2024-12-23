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
use Filament\Forms\Components\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\TemporaryUploadedFile;

class FloorResource extends Resource
{
    protected static ?string $model = Floor::class;

    protected static ?string $navigationLabel = 'Floors';
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
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
                ->afterStateUpdated(function ($state, $set) {
                    $set('teams', []);
                });
        }

        $schema[] = TextInput::make('name')
            ->required()
            ->maxLength(255);

        $schema[] = TextInput::make('floor_number')
            ->required()
            ->numeric();

        $schema[] = Select::make('type')
            ->options([
                'Office Floor' => 'Office Floor',
                'Other Activities' => 'Other Activities'
            ])
            ->required()
            ->default('Office Floor')
            ->live();

        $schema[] = FileUpload::make('image')
            ->image()
            ->directory('floor-images')
            ->visibility('public')
            ->maxSize(5120)
            ->hidden(fn (Forms\Get $get): bool => $get('type') !== 'Other Activities')
            ->helperText('Optional. Only for Other Activities floors.')
            ->columnSpanFull()
            ->preserveFilenames()
            ->downloadable()
            ->openable()
            ->dehydrateStateUsing(fn ($state) => $state ? $state[0] : null);

        $schema[] = Select::make('teams')
            ->multiple()
            ->relationship('teams', 'name', function (Builder $query, $get) {
                $companyId = $get('company_id');
                if ($companyId) {
                    $query->where('company_id', $companyId);
                }
                return $query;
            })
            ->preload()
            ->searchable()
            ->afterStateHydrated(function ($state, $set, $record) {
                if ($record) {
                    $set('teams', $record->teams->pluck('id')->toArray());
                }
            });

        return $form->schema($schema);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();
        \Log::info('Creating floor with user:', [
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'is_manager' => $user->hasRole('Manager'),
            'data' => $data
        ]);

        if ($user->hasRole('Manager')) {
            if (!$user->company_id) {
                \Log::warning('Manager has no company_id assigned');
            }
            $data['company_id'] = $user->company_id;
        }

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('company.name')->label('Company')->sortable()->searchable(),
                TextColumn::make('name')->label('Floor Name')->sortable()->searchable(),
                TextColumn::make('floor_number')->label('Floor Number')->sortable()->searchable(),
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