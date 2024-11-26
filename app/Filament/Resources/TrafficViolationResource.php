<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrafficViolationResource\Pages;
use App\Models\TrafficViolation;
use App\Services\ConditionEvaluator;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
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

    public static function createViolation(TrafficViolation $violation, array $detectionData): void
    {
        $evaluator = app(ConditionEvaluator::class);
        $conditions = $violation->conditions; // Obtener condiciones almacenadas en la base de datos

        foreach ($conditions as $condition) {
            if ($evaluator->evaluate($condition, $detectionData)) {
                // Registrar la infracción
                $violation->triggered = true;
                $violation->save();
            }
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Textarea::make('condition')
                            ->label('Expresión de Condición')
                            ->helperText('Usa el lenguaje de expresiones de Symfony. Ejemplo: speed > 80 and time >= "06:00" and time <= "22:00"')
                            ->required(),
                TextInput::make('helper_text')
                    ->label('Helper Text')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('helper_text'),
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
