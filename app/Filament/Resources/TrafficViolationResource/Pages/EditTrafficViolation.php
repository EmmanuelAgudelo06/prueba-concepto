<?php

namespace App\Filament\Resources\TrafficViolationResource\Pages;

use App\Filament\Resources\TrafficViolationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrafficViolation extends EditRecord
{
    protected static string $resource = TrafficViolationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
