<?php

declare(strict_types=1);

namespace TemperatureSensor\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use TemperatureSensor\Models\TemperatureSensor;

class SensorRepository
{
    public function getByUuidOrFail(string $uuid): TemperatureSensor
    {
        $sensor = TemperatureSensor::query()->where('uuid', '=', $uuid)->get()->first();
        if (!$sensor) {
            throw new ModelNotFoundException("Temperature Sensor not found for UUID: $uuid");
        }

        return $sensor;
    }

    public function create(): TemperatureSensor
    {
        $sensor = new TemperatureSensor();
        $sensor->save();

        return $sensor;
    }

    public function delete(TemperatureSensor $temperatureSensor): TemperatureSensor
    {
        $temperatureSensor->delete();

        return $temperatureSensor;
    }
}
