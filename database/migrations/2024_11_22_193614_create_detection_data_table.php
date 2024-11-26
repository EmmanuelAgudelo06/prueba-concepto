<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detection_data', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('device_id')->constrained();
            $table->datetime('detection_time');
            $table->double('speed')->nullable();
            $table->enum('signal_state', ['red', 'yellow', 'green'])->nullable();
            $table->string('location');
            $table->json('other_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detection_data');
    }
};