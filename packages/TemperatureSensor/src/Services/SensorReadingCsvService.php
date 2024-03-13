<?php

declare(strict_types=1);

namespace TemperatureSensor\Services;

use TemperatureSensor\Models\TemperatureSensor;

class SensorReadingCsvService
{
    private const CSV_HEADER = 'reading_id,temperature_celsius';

    public function getSensorReadingCsvString(TemperatureSensor $temperatureSensor): string
    {
        $readings = $temperatureSensor->readings->select('id', 'temperature_celsius')->toArray();

        return $this->convertArrayToCsvString($readings);
    }

    private function convertArrayToCsvString(array $readings): string
    {
        $data = self::CSV_HEADER;
        foreach ($readings as $reading) {
            $data .= PHP_EOL . implode(',', $reading);
        }

        return $data;
    }
}
