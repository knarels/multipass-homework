<?php

declare(strict_types=1);

namespace TemperatureSensor\Helpers;

class ConvertTemperatureHelper
{
    public static function convertFahrenheitToCelsius(float $temperatureInFahrenheit): float
    {
        return round(($temperatureInFahrenheit - 32) * (5 / 9), 3);
    }
}
