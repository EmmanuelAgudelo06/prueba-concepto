<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ViolationRecord extends Model
{
    protected $fillable = [
        'detection_data_id',
        'traffic_violation_id',
        'details',
        'triggered_at',
    ];

    public function detectionData(): BelongsTo
    {
        return $this->belongsTo(DetectionData::class);
    }

    public function trafficViolation(): BelongsTo
    {
        return $this->belongsTo(TrafficViolation::class);
    }
}
