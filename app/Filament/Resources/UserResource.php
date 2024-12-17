<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model; 
use App\Filament\Resources\UserResource\Pages;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Settings';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(['Administrator', 'Manager']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole(['Administrator', 'Manager']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('Administrator');
    }

    public static function form(Form $form): Form
    {
        $schema = [];

        // Only show company selection for Administrators
        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required();
        }

        // Basic user fields
        $schema[] = Forms\Components\TextInput::make('name')
            ->required()
            ->maxLength(255);

        $schema[] = Forms\Components\TextInput::make('email')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(ignoreRecord: true);

        $schema[] = Forms\Components\TextInput::make('password')
            ->password()
            ->required()
            ->minLength(8)
            ->dehydrated(fn ($state) => filled($state))
            ->dehydrateStateUsing(fn ($state) => Hash::make($state));

        // Team selection (filtered by company for managers)
        $schema[] = Forms\Components\Select::make('team_id')
            ->relationship('team', 'name', function ($query) {
                if (auth()->user()->hasRole('Manager')) {
                    return $query->where('company_id', auth()->user()->company_id);
                }
                return $query;
            })
            ->required();

        // Role selection (managers can only assign Employee role)
        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Forms\Components\Select::make('roles')
                ->multiple()
                ->relationship('roles', 'name')
                ->preload();
        } else {
            $schema[] = Forms\Components\Hidden::make('roles')
                ->default(['Employee']);
        }

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('team.name')
                    ->label('Team')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        if (auth()->user()->hasRole('Manager')) {
            return $query->where('company_id', auth()->user()->company_id);
        }
        
        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}