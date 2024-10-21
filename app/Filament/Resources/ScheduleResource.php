<?php

namespace App\Filament\Resources;

use App\Models\Schedule;
use App\Models\Process;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; 
use App\Filament\Resources\ScheduleResource\Pages;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationLabel = 'Schedules';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        $schema = [];

        if (auth()->user()->hasRole('Administrator')) {
            $schema[] = Forms\Components\Select::make('process_id')
                ->relationship('process', 'name')
                ->required()
                ->label('Process');
        } else {
            $schema[] = Forms\Components\Select::make('process_id')
                ->options(
                    Process::where('company_id', auth()->user()->company_id)
                        ->pluck('name', 'id') 
                )
                ->required()
                ->label('Process');
        }

        // Add the schedule fields after the process selection
        $schema[] = Forms\Components\TextInput::make('schedule_type')
            ->required()
            ->label('Schedule Type');

        $schema[] = Forms\Components\TextInput::make('start_time')
            ->required()
            ->label('Start Time');

        $schema[] = Forms\Components\TextInput::make('end_time')
            ->required()
            ->label('End Time');

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('process.name')->label('Process'),
                Tables\Columns\TextColumn::make('schedule_type')->label('Schedule Type'),
                Tables\Columns\TextColumn::make('start_time')->label('Start Time'),
                Tables\Columns\TextColumn::make('end_time')->label('End Time'),
                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->sortable(),
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

        return parent::getEloquentQuery()->whereHas('process', function ($query) {
            $query->where('company_id', auth()->user()->company_id);
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}