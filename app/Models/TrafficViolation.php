<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrafficViolation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'condition',
        'description',
    ];

    protected $casts = [
        'condition' => 'array',
    ];

    public function violationRecords(): HasMany
    {
        return $this->hasMany(ViolationRecord::class);
    }
}
