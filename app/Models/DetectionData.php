<?php

namespace App\Models;

use App\Events\DetectionDataCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetectionData extends Model
{
    use HasFactory;
    protected $fillable = [
//        'device_id',
        'detection_time',
        'speed',
        'signal_state',
        'location',
        'other_data',
    ];

    protected $casts = [
        'detection_time' => 'datetime',
        'other_data' => 'array',
    ];

    protected static function booted()
    {
        static::created(function ($detectionData) {
            event(new DetectionDataCreated($detectionData));
        });
    }

    public function violationRecords(): HasMany
    {
        return $this->hasMany(ViolationRecord::class);
    }
}
