<?php

namespace App\Filament\Resources;

use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;


class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static ?string $navigationGroup = 'Information';

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

        $schema[] = Forms\Components\TextInput::make('categories')
            ->required()
            ->label('Categories')
            ->maxLength(255)
            ->regex('/^[a-zA-Z0-9\s,]+$/')
            ->helperText('Separate categories with commas');

        $schema[] = Forms\Components\TextInput::make('title')
            ->required()
            ->label('Title')
            ->maxLength(255);

        $schema[] = Forms\Components\Textarea::make('description')
            ->required()
            ->label('Description')
            ->maxLength(1000);

        $schema[] = Forms\Components\TextInput::make('url')
            ->url()
            ->label('Resource URL')
            ->maxLength(255)
            ->regex('/^https?:\/\/.+/')
            ->helperText('Must be a valid URL starting with http:// or https://');

        $schema[] = FileUpload::make('pdf_file')
            ->label('PDF Document')
            ->directory('resource-pdfs')
            ->acceptedFileTypes(['application/pdf'])
            ->maxSize(10240)
            ->downloadable()
            ->openable()
            ->preserveFilenames()
            ->helperText('Maximum file size: 10MB. Only PDF files are accepted.');

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')->sortable(),
                TextColumn::make('categories')->sortable()->searchable(),
                TextColumn::make('title')->sortable(),
                TextColumn::make('description')->sortable(),
                TextColumn::make('url')->sortable(),
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
            'index' => ResourceResource\Pages\ListResources::route('/'),
            'create' => ResourceResource\Pages\CreateResource::route('/create'),
            'edit' => ResourceResource\Pages\EditResource::route('/{record}/edit'),
        ];
    }
}