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
use Filament\Forms\Components\Select;

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
        $schema = [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->maxLength(255)
                ->hiddenOn('edit'),
        ];

        // Company selection for administrators
        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required()
                ->live()
                ->afterStateUpdated(fn ($state, callable $set) => $set('team_id', null));
        }

        // Team selection (filtered by selected company)
        $schema[] = Select::make('team_id')
            ->relationship(
                'team',
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
            ->required()
            ->disabled(fn ($get) => auth()->user()->hasRole('Administrator') && !$get('company_id'))
            ->helperText(fn ($get) => auth()->user()->hasRole('Administrator') && !$get('company_id') 
                ? 'Select a company first' 
                : null);

        // Role Information selection
        $schema[] = Select::make('role_information_id')
            ->relationship(
                'roleInformation',
                'title',
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
            ->label('Role in the company')
            ->disabled(fn ($get) => auth()->user()->hasRole('Administrator') && !$get('company_id'))
            ->helperText(fn ($get) => auth()->user()->hasRole('Administrator') && !$get('company_id') 
                ? 'Select a company first' 
                : null);

        // Role selection (single role)
        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Select::make('role')
                ->relationship('roles', 'name')
                ->preload()
                ->required()
                ->label('Role');
        } else {
            $schema[] = Forms\Components\Hidden::make('role')
                ->default('Employee');
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