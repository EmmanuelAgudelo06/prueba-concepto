<?php

namespace Database\Seeders;

use App\Models\TrafficViolation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrafficViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $violations = [
            ['code' => '74550', 'name' => 'Velocidad', 'description' => '', 'condition' => []],
            ['code' => '60503', 'name' => 'Semaforo', 'description' => '', 'condition' => []],
            ['code' => '30003', 'name' => 'RTM', 'description' => '', 'condition' => []],
            ['code' => '30004', 'name' => 'SOAT', 'description' => '', 'condition' => []],
            ['code' => '30005', 'name' => 'MVI', 'description' => '', 'condition' => []],
            ['code' => '57462', 'name' => 'PYP', 'description' => '', 'condition' => []],
            ['code' => '56732', 'name' => 'CEBRA', 'description' => '', 'condition' => []],
            ['code' => '57030', 'name' => '3.5', 'description' => '', 'condition' => []],
        ];

        foreach ($violations as $violation) {
            TrafficViolation::create($violation); // @phpstan-ignore-line
        }
    }
}
