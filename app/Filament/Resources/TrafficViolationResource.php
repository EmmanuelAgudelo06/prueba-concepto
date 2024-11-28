<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrafficViolationResource\Pages;
use App\Models\TrafficViolation;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TrafficViolationResource extends Resource
{
    protected static ?string $model = TrafficViolation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//    public static function createViolation(TrafficViolation $violation, array $detectionData): void
//    {
//        $evaluator = app(ConditionEvaluator::class);
//        $conditions = $violation->conditions; // Obtener condiciones almacenadas en la base de datos
//
//        foreach ($conditions as $condition) {
//            if ($evaluator->evaluate($condition, $detectionData)) {
//                // Registrar la infracción
//                $violation->triggered = true;
//                $violation->save();
//            }
//        }
//    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code'),
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Repeater::make('condition')
                    ->schema([
                        Select::make('variable')
                            ->options([
                                'speed' => 'Velocidad',
                                'plate' => 'Placa',
                                'type' => 'Tipo',
                                'date' => 'Fecha',
                                'hour' => 'Hora',
                            ])
                            ->required(),
                        Select::make('operator')
                            ->options([
                                '==' => 'Igual a',
                                '!=' => 'Diferente de',
                                '<' => 'Menor que',
                                '<=' => 'Menor o igual que',
                                '>' => 'Mayor que',
                                '>=' => 'Mayor o igual que',
                            ])
                            ->required(),
                        TextInput::make('value')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(3),
                TextInput::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('name'),
                TextColumn::make('conditions')
                    ->getStateUsing(function ($record) {
                        return collect($record->condition)
                            ->map(fn($condition) => "{$condition['variable']} {$condition['operator']} {$condition['value']}")
                            ->join(' AND ');
                    }),
                TextColumn::make('description')
                    ->wrap(),
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
            'index' => Pages\ListTrafficViolations::route('/'),
            'create' => Pages\CreateTrafficViolation::route('/create'),
            'edit' => Pages\EditTrafficViolation::route('/{record}/edit'),
        ];
    }
}
