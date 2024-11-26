<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrafficViolation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'condition',
        'helper_text'
    ];

    protected $casts = [
        'conditions' => 'array',
    ];

    public function violationRecords(): HasMany
    {
        return $this->hasMany(ViolationRecord::class);
    }
}
