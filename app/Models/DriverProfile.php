<?php
// app/Models/DriverProfile.php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'license_number', 'license_expiry', 'is_available'])]
class DriverProfile extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'license_expiry' => 'date',
            'is_available' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'driver_vehicle')->withTimestamps();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(DriverDocument::class);
    }
}