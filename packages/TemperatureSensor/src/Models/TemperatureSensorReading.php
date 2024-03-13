<?php

declare(strict_types=1);

namespace TemperatureSensor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use TemperatureSensor\Factories\Domain\TemperatureSensor\Models\TemperatureSensorReadingFactory;

/**
 * @property int $id
 * @property float $temperature_celsius
 */
class TemperatureSensorReading extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['sensor_uuid', 'temperature_fahrenheit', 'temperature_celsius'];

    public function sensor(): BelongsTo
    {
        return $this->belongsTo(TemperatureSensor::class, 'sensor_uuid');
    }

    protected static function newFactory(): TemperatureSensorReadingFactory
    {
        return TemperatureSensorReadingFactory::new();
    }
}
