<?php

namespace TemperatureSensor\Seeders;

use Illuminate\Database\Seeder;
use TemperatureSensor\Models\TemperatureSensor;
use TemperatureSensor\Models\TemperatureSensorReading;

class TemperatureSensorSeeder extends Seeder
{
    public function run(): void
    {
        TemperatureSensor::factory(10)
            ->has(TemperatureSensorReading::factory()->count(50), 'readings')
            ->create();
    }
}
