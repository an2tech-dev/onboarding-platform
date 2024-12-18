<?php

namespace App\Filament\Resources;

use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ResourceResource\Pages;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationLabel = 'Resources';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        $schema = [];

        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required()
                ->label('Company');
        } else {
            $schema[] = Forms\Components\Select::make('company_id')
                ->options([
                    auth()->user()->company_id => auth()->user()->company->name 
                ])
                ->required()
                ->label('Company')
                ->default(auth()->user()->company_id); 
        }

        $schema[] = Forms\Components\TextInput::make('categories')
            ->required()
            ->label('Categories');

        $schema[] = Forms\Components\TextInput::make('title')
            ->required()
            ->label('Title');

        $schema[] = Forms\Components\Textarea::make('description')
            ->required()
            ->label('Description');

        $schema[] = Forms\Components\TextInput::make('url')
            ->url()
            ->required()
            ->label('Resource URL');

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categories')
                    ->label('Categories')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('Resource URL')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([])
            ->searchable();
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
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
        ];
    }
}