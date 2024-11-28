<?php

namespace App\Filament\Resources\TrafficViolationResource\Pages;

use App\Filament\Resources\TrafficViolationResource;
use App\Models\TrafficViolation;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrafficViolation extends CreateRecord
{
    protected static string $resource = TrafficViolationResource::class;

}
