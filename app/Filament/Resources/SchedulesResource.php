<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchedulesResource\Pages;
use App\Models\Schedules;
use App\Models\Processes;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchedulesResource extends Resource
{
    protected static ?string $model = Schedules::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('process_id')
                    ->label('Process')
                    ->relationship('process', 'name') 
                    ->required(),
                Select::make('schedule_type')
                    ->options([
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                    ])
                    ->label('Schedule Type')
                    ->required(),
                TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required(),
                TimePicker::make('end_time')
                    ->label('End Time')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('process.name')->label('Process'),
                Tables\Columns\TextColumn::make('schedule_type')->label('Schedule Type'),
                Tables\Columns\TextColumn::make('start_time')->label('Start Time'),
                Tables\Columns\TextColumn::make('end_time')->label('End Time'),
            ])
            ->filters([
                
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedules::route('/create'),
            'edit' => Pages\EditSchedules::route('/{record}/edit'),
        ];
    }
}
