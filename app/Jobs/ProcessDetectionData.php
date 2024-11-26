<?php

namespace App\Jobs;

use App\Filament\Resources\TrafficViolationResource;
use App\Models\DetectionData;
use App\Models\TrafficViolation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessDetectionData implements ShouldQueue
{
    use Queueable;

    protected string $name;

    protected string $base64;


    /**
     * Create a new job instance.
     */
    public function __construct(string $name, string $base64)
    {
        $this->name = $name;
        $this->base64 = $base64;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        dd($this->name, $this->base64);
        $violations = TrafficViolation::all();

        foreach ($violations as $violation) {
            TrafficViolationResource::createViolation($violation, $data->toArray());
        }
    }
}
