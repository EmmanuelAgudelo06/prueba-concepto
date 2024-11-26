<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViolationRecordResource\Pages;
use App\Filament\Resources\ViolationRecordResource\RelationManagers;
use App\Models\ViolationRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViolationRecordResource extends Resource
{
    protected static ?string $model = ViolationRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('detection_data_id')
                    ->label('Detection Data ID')
                    ->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('detection_data_id'),
                Tables\Columns\TextColumn::make('traffic_violation_id'),
                Tables\Columns\TextColumn::make('details'),
                Tables\Columns\TextColumn::make('triggered_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListViolationRecords::route('/'),
            'create' => Pages\CreateViolationRecord::route('/create'),
            'edit' => Pages\EditViolationRecord::route('/{record}/edit'),
        ];
    }
}
