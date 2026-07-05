<?php

// app/Enums/VehicleStatus.php
namespace App\Enums;

enum VehicleStatus: string
{
    case Active = 'active';
    case Maintenance = 'maintenance';
    case Retired = 'retired';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Maintenance => 'In Maintenance',
            self::Retired => 'Retired',
        };
    }

    /**
     * Whether this vehicle can currently be assigned to a route.
     * Used later in Phase 8 (Vehicle-Route Assignment).
     */
    public function isAssignable(): bool
    {
        return $this === self::Active;
    }
}