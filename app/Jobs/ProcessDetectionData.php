<?php

namespace App\Jobs;

use App\Filament\Resources\TrafficViolationResource;
use App\Models\DetectionData;
use App\Models\TrafficViolation;
use App\Models\ViolationRecord;
use App\Services\ConditionEvaluator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use function Termwind\parse;

class ProcessDetectionData implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

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
        try {
            // Resolver el evaluador usando el contenedor de servicios
            $evaluator = app(ConditionEvaluator::class);

            $mediaData = $this->getMediaData($this->name);
            $trafficViolation = TrafficViolation::where('code', $mediaData['violation_code'])->first();
            $expression = collect($trafficViolation->condition)
                ->map(fn($condition) => "{$condition['variable']} {$condition['operator']} {$condition['value']}")
                ->join(' AND ');

            $context = [
                'speed' => intval($mediaData['vehicle_speed']),
            ];
            if ($evaluator->evaluate($expression, $context)) {
                // Registrar la infracción detectada
//                ViolationRecord::create([
//                    'detection_data_id' => $event->detectionData->id,
//                    'traffic_violation_id' => $trafficViolation->id,
//                    'details' => $trafficViolation->name,
//                    'triggered_at' => now(),
//                ]);
            }
            
            dd('Infracción no detectada');

            Log::info('Photo ticket processed successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to process photo ticket: ' . $e->getMessage());
        }
    }


    private function getMediaData(string $nameMedia): array
    {
        $mediaData = [];

        $nameArray = explode('_', str_replace('.', '_', $nameMedia));

        $keyNames = [
            'device_code',
            'foreign_name',
            'certificate',
            'inmetro_date',
            'calibration_date',
            'calibration_date_two',
            'line_number',
            'violation_date',
            'violation_time',
            'code',
            'speed_limit_one',
            'speed_limit_two',
            'vehicle_speed',
            'unknown_one',
            'vehicle_size',
            'vehicle_plate',
            'framing',
            'unknown_two',
            'unknown_three',
            'unknown_four',
            'unknown_five',
            'media_code',
            'violation_code',
            'unknown_six',
            'unknown_seven',
            'unknown_eight',
            'unknown_nine',
            'media_format',
        ];

        foreach ($nameArray as $index => $element) {
            !empty($element) && isset($keyNames[$index]) && $mediaData[$keyNames[$index]] = $element;
        }

        return $mediaData;
    }
}
