<?php

namespace TemperatureSensor\Factories\Domain\TemperatureSensor\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use TemperatureSensor\Models\TemperatureSensor;

class TemperatureSensorFactory extends Factory
{
    protected $model = TemperatureSensor::class;

    public function definition(): array
    {
        return ['uuid' => fake()->unique()->uuid()];
    }
}
