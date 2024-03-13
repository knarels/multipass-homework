<?php

namespace TemperatureSensor\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorReadingUpdateRequest extends FormRequest
{
    public string $wrapper = 'temperatureSensorReadingInfo';

    public function rules(): array
    {
        return [
            $this->wrapper => 'required|array',
            "$this->wrapper.id" => 'required|int|exists:temperature_sensor_readings,id',
            "$this->wrapper.temperature_fahrenheit" => 'sometimes|decimal:0,3',
            "$this->wrapper.temperature_celsius" => 'sometimes|decimal:0,3',
        ];
    }
}
