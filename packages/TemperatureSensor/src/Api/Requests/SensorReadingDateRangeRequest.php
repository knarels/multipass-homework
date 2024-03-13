<?php

namespace TemperatureSensor\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorReadingDateRangeRequest extends FormRequest
{
    public string $wrapper = 'temperatureSensorReadingInfo';

    public function rules(): array
    {
        return [
            $this->wrapper => 'required|array',
            "$this->wrapper.start_date" => 'required|date',
            "$this->wrapper.end_date" => "required|date|after_or_equal:$this->wrapper.start_date",
        ];
    }
}
