<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetectionDataResource\Pages;
use App\Models\DetectionData;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetectionDataResource extends Resource
{
    protected static ?string $model = DetectionData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                TextInput::make('device_id')
//                    ->label('Device ID')
//                    ->required(),
                DateTimePicker::make('detection_time')
                    ->label('Detection Time')
                    ->required(),
                TextInput::make('speed'),
                Select::make('signal_state')
                    ->label('Signal State')
                    ->required()
                    ->options([
                        'red' => 'Red',
                        'yellow' => 'Yellow',
                        'green' => 'Green',
                    ]),
                Textarea::make('location'),
                Textarea::make('other_data'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('detection_time')->dateTime(),
               TextColumn::make('speed'),
               TextColumn::make('signal_state'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
               BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetectionData::route('/'),
            'create' => Pages\CreateDetectionData::route('/create'),
            'edit' => Pages\EditDetectionData::route('/{record}/edit'),
        ];
    }
}
