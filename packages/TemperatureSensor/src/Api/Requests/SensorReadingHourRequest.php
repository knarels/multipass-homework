<?php

namespace TemperatureSensor\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorReadingHourRequest extends FormRequest
{
    public string $wrapper = 'temperatureSensorReadingInfo';

    public function rules(): array
    {
        return [
            $this->wrapper => 'required|array',
            "$this->wrapper.date_hour" => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
