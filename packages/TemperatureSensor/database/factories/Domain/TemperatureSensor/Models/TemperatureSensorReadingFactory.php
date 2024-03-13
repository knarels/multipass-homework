<?php

namespace TemperatureSensor\Factories\Domain\TemperatureSensor\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use TemperatureSensor\Helpers\ConvertTemperatureHelper;
use TemperatureSensor\Models\TemperatureSensorReading;

class TemperatureSensorReadingFactory extends Factory
{
    protected $model = TemperatureSensorReading::class;

    public function definition(): array
    {
        $temperatureInFahrenheit = fake()->randomFloat(3, -300, 300);
        $temperatureInCelsius = ConvertTemperatureHelper::convertFahrenheitToCelsius($temperatureInFahrenheit);

        return [
            'temperature_fahrenheit' => $temperatureInFahrenheit,
            'temperature_celsius' => $temperatureInCelsius,
            'created_at' => fake()->dateTimeBetween('-1 days')
        ];
    }
}
