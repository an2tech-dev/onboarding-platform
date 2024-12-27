<?php

namespace App\Filament\Resources;

use App\Models\RoleInformation;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RoleInformationResource extends Resource
{
    protected static ?string $model = RoleInformation::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Information';
    protected static ?string $navigationLabel = 'Role Information';

    public static function form(Form $form): Form
    {
        $schema = [];

        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required();
        }

        $schema[] = Forms\Components\TextInput::make('title')
            ->required()
            ->maxLength(255);

        $schema[] = Forms\Components\Textarea::make('description')
            ->required()
            ->maxLength(65535);

        $schema[] = Forms\Components\Textarea::make('expectations')
            ->required()
            ->maxLength(65535);

        $schema[] = Forms\Components\RichEditor::make('next_steps')
            ->label('Next Steps') 
            ->required()
            ->maxLength(65535);

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')->sortable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->limit(50),
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
            'index' => RoleInformationResource\Pages\ListRoleInformation::route('/'),
            'create' => RoleInformationResource\Pages\CreateRoleInformation::route('/create'),
            'edit' => RoleInformationResource\Pages\EditRoleInformation::route('/{record}/edit'),
        ];
    }
}