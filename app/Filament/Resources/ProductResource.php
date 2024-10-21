<?php

namespace App\Filament\Resources;

use App\Models\Product;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\ProductResource\Pages;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Products';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart'; 

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
            ->label('Product Name');

        $schema[] = Textarea::make('description')
            ->label('Product Description')
            ->nullable();

        $schema[] = DatePicker::make('release_date')
            ->label('Release Date')
            ->nullable()
            ->displayFormat('Y-m-d');

        $schema[] = FileUpload::make('product_image')
            ->label('Product Image')
            ->image()
            ->nullable();

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('company.name')->label('Company')->sortable(),
                TextColumn::make('name')->label('Product Name')->sortable(),
                TextColumn::make('description')->label('Description')->limit(50),
                TextColumn::make('release_date')->label('Release Date')->date(),
                ImageColumn::make('product_image')->label('Product Image'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'), 
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}