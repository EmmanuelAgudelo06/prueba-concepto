<?php

namespace App\Listeners;

use App\Events\DetectionDataCreated;
use App\Models\TrafficViolation;
use App\Models\ViolationRecord;
use App\Services\ConditionEvaluator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessDetectionData
{
    protected $evaluator;

    public function __construct(ConditionEvaluator $evaluator)
    {
        $this->evaluator = $evaluator;
    }

    /**
     * Handle the event.
     */
    public function handle(DetectionDataCreated $event)
    {
        $data = $event->detectionData->toArray();
        $violations = TrafficViolation::all();
        foreach ($violations as $violation) {
            $expression = $violation->condition;
            // Puedes agregar más datos al array según sea necesario
            $context = [
                    'speed' => $data['speed'],
                    'detection_time' => $data['detection_time'],
                    'location' => $data['location'],
                    // Agrega otros campos si es necesario
                ];
            if ($this->evaluator->evaluate($expression, $context)) {
                // Registrar la infracción detectada
                    ViolationRecord::create([
                        'detection_data_id' => $event->detectionData->id,
                        'traffic_violation_id' => $violation->id,
                        'details' => $violation->name,
                        'triggered_at' => now(),
                    ]);
                    // Opcional: Puedes detener la evaluación si solo necesitas la primera infracción
                    // break 2;
                }
        }
    }
}
