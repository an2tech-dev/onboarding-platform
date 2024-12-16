<?php

namespace App\Filament\Resources;

use App\Models\Process;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;

class ProcessResource extends Resource
{
    protected static ?string $model = Process::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            $schema[] = Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required();
        }

        $schema[] = Forms\Components\TextInput::make('name')
            ->required()
            ->maxLength(255);

        $schema[] = Forms\Components\Select::make('type')
            ->options([
                'workflow' => 'Workflow',
                'information' => 'Information'
            ])
            ->required()
            ->default('workflow')
            ->live();

        $schema[] = Forms\Components\TextInput::make('description')
            ->required()
            ->maxLength(255);

        $schema[] = Repeater::make('workflow_data')
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->directory('workflow-images')
                    ->visibility('public')
                    ->maxSize(5120)
            ])
            ->columns(1)
            ->hidden(fn (Forms\Get $get): bool => $get('type') !== 'workflow')
            ->defaultItems(1)
            ->addActionLabel('Add Workflow Step')
            ->collapsible()
            ->cloneable()
            ->columnSpanFull()
            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null);

        $schema[] = Repeater::make('information_data')
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->nullable(),
                Forms\Components\Textarea::make('information')
                    ->nullable(),
                Forms\Components\Toggle::make('has_schedule')
                    ->label('Enable Schedule')
                    ->default(false)
                    ->live(),
                Forms\Components\TextInput::make('schedule_title')
                    ->nullable()
                    ->hidden(fn (Forms\Get $get): bool => !$get('has_schedule')),
                Forms\Components\Textarea::make('schedule_text')
                    ->nullable()
                    ->hidden(fn (Forms\Get $get): bool => !$get('has_schedule')),
                Forms\Components\Toggle::make('has_image')
                    ->label('Enable Image')
                    ->default(false)
                    ->live(),
                FileUpload::make('image')
                    ->image()
                    ->directory('information-images')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->hidden(fn (Forms\Get $get): bool => !$get('has_image'))
            ])
            ->columns(1)
            ->hidden(fn (Forms\Get $get): bool => $get('type') !== 'information')
            ->defaultItems(1)
            ->addActionLabel('Add Information')
            ->collapsible()
            ->cloneable()
            ->columnSpanFull()
            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Information Item');

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')->sortable(),
                TextColumn::make('name')->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'workflow' => 'success',
                        'information' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('description')->sortable(),
            ])
            ->filters([])
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

        return parent::getEloquentQuery()->where('company_id', auth()->user()->company_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => ProcessResource\Pages\ListProcesses::route('/'),
            'create' => ProcessResource\Pages\CreateProcess::route('/create'),
            'edit' => ProcessResource\Pages\EditProcess::route('/{record}/edit'),
        ];
    }
}