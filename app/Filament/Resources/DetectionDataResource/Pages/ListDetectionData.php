<?php

namespace App\Filament\Resources\DetectionDataResource\Pages;

use App\Filament\Resources\DetectionDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetectionData extends ListRecords
{
    protected static string $resource = DetectionDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
