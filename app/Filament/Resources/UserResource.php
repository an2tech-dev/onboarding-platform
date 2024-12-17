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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Settings';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('Administrator');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('Administrator');
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
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name'),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique('users', 'email', ignoreRecord: true)
                    ->label('Email'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->nullable()
                    ->label('Password')
                    ->dehydrateStateUsing(fn ($state) => $state ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Leave blank to keep the current password.'),
                Forms\Components\Select::make('company_id')
                    ->relationship('company', 'name')
                    ->nullable() 
                    ->label('Company'),
                Forms\Components\Select::make('roles') 
                    ->label('Role')
                    ->options(Role::all()->pluck('name', 'name')) 
                    ->relationship('roles', 'name') 
                    ->required() 
                    ->disablePlaceholderSelection(),
                Forms\Components\Select::make('role_information_id')
                    ->label('Role within company')
                    ->relationship(
                        'roleInformation',
                        'title',
                        fn (Builder $query) => auth()->user()->hasRole('Administrator') 
                            ? $query 
                            : $query->where('company_id', auth()->user()->company_id)
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('company.name')->label('Company'),
                Tables\Columns\TextColumn::make('roles.name')->label('Role') 
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
            //     Tables\Columns\TextColumn::make('created_at')->label('Created At')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
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