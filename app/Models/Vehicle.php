<?php
// app/Models/Vehicle.php
namespace App\Models;

use App\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['vehicle_type_id', 'registration_number', 'make', 'model', 'year', 'capacity', 'status'])]
class Vehicle extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => VehicleStatus::class,
            'year' => 'integer',
            'capacity' => 'integer',
        ];
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }
}