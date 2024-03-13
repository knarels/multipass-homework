<?php

declare(strict_types=1);

namespace TemperatureSensor\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use TemperatureSensor\Factories\Domain\TemperatureSensor\Models\TemperatureSensorFactory;

/**
 * @property Collection $readings
 */
class TemperatureSensor extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    public function readings(): HasMany
    {
        return $this->hasMany(TemperatureSensorReading::class, 'sensor_uuid');
    }

    protected static function newFactory(): TemperatureSensorFactory
    {
        return TemperatureSensorFactory::new();
    }

    public static function boot(): void
    {
        parent::boot();

        self::deleting(static function (TemperatureSensor $sensor) {

            foreach ($sensor->readings as $reading) {
                $reading->delete();
            }
        });
    }
}
