<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'temperature_sensor_readings';

    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->uuid('sensor_uuid');
            $table->decimal('temperature_fahrenheit', 6, 3);
            $table->decimal('temperature_celsius', 6, 3);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sensor_uuid')->references('uuid')->on('temperature_sensors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
