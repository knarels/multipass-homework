<?php

namespace TemperatureSensor\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorReadingCreateRequest extends FormRequest
{
    public string $wrapper = 'temperatureSensorReadingInfo';

    public function rules(): array
    {
        return [
            $this->wrapper => 'required|array',
            "$this->wrapper.sensor_uuid" => 'required|string|exists:temperature_sensors,uuid',
            "$this->wrapper.temperature_fahrenheit" => 'required|decimal:0,3'
        ];
    }
}
