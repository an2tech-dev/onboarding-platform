<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\DateFilter;
use Filament\Tables\Filters\TextFilter;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
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
            $schema[] = Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required();
        }

        $schema[] = Forms\Components\TextInput::make('name')
            ->required()
            ->maxLength(255)
            ->regex('/^[a-zA-Z0-9\s\-_]+$/')
            ->helperText('Only letters, numbers, spaces, hyphens and underscores allowed');

        $schema[] = Forms\Components\Textarea::make('description')
            ->required()
            ->maxLength(1000)
            ->minLength(10)
            ->helperText('Between 10 and 1000 characters');

        $schema[] = Forms\Components\DatePicker::make('release_date')
            ->label('Release Date')
            ->nullable()
            ->native(false)
            ->displayFormat('F j, Y')
            ->format('Y-m-d')
            ->rules(['nullable', 'date'])
            ->placeholder('Select release date (optional)');

        $schema[] = Forms\Components\FileUpload::make('product_image')
            ->label('Product Image')
            ->image()
            ->directory('product-images')
            ->visibility('public')
            ->maxSize(5120)
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->helperText('Maximum size: 5MB. Accepted types: JPG, PNG, WebP')
            ->preserveFilenames()
            ->downloadable()
            ->openable();

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')->sortable()->searchable(),
                TextColumn::make('name')
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(), 
                TextColumn::make('release_date')
                    ->label('Release Date')
                    ->date()
                    ->sortable(),
                ImageColumn::make('product_image')->label('Product Image'),
            ])
            ->filters([
                SelectFilter::make('company_id')
                    ->label('Filter by Company')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload(),
    
                SelectFilter::make('name')
                    ->label('Filter by Product Name')
                    ->options(fn () => Product::pluck('name', 'name')->toArray())
                    ->searchable(),
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

        return parent::getEloquentQuery()->where('company_id', auth()->user()->company_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => ProductResource\Pages\ListProducts::route('/'),
            'create' => ProductResource\Pages\CreateProduct::route('/create'),
            'edit' => ProductResource\Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}