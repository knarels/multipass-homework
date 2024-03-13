<?php

declare(strict_types=1);

namespace TemperatureSensor\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TemperatureSensor\Models\TemperatureSensorReading;

class SensorReadingRepository
{
    public function getByIdOrFail(int $id): TemperatureSensorReading
    {
        $temperatureSensorReading = TemperatureSensorReading::query()->where('id', '=', $id)->get()->first();
        if (!$temperatureSensorReading) {
            throw new ModelNotFoundException("Temperature Sensor Reading not found for ID: $id");
        }

        return $temperatureSensorReading;
    }

    public function create(array $data): TemperatureSensorReading
    {
        $temperatureSensorReading = new TemperatureSensorReading();
        $temperatureSensorReading->fill($data);
        $temperatureSensorReading->save();

        return $temperatureSensorReading;
    }

    public function update(TemperatureSensorReading $temperatureSensorReading, array $data): TemperatureSensorReading
    {
        $temperatureSensorReading->update($data);

        return $temperatureSensorReading;
    }

    public function delete(TemperatureSensorReading $temperatureSensorReading): TemperatureSensorReading
    {
        $temperatureSensorReading->delete();

        return $temperatureSensorReading;
    }

    public function getAverageTemperaturesInDateRange(Carbon $startDate, Carbon $endDate): TemperatureSensorReading
    {
        return TemperatureSensorReading::query()
            ->selectRaw('
                ROUND(AVG(temperature_fahrenheit), 3) AS avg_temperature_fahrenheit,
                ROUND(AVG(temperature_celsius), 3) AS avg_temperature_celsius
            ')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get()
            ->first();
    }
}
