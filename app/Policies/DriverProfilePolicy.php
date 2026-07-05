<?php

namespace App\Policies;

use App\Models\DriverProfile;
use App\Models\User;

class DriverProfilePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('drivers.manage');
    }

    public function view(User $user, DriverProfile $driverProfile): bool
    {
        return $user->hasPermission('drivers.manage');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('drivers.manage');
    }

    public function update(User $user, DriverProfile $driverProfile): bool
    {
        return $user->hasPermission('drivers.manage');
    }

    public function delete(User $user, DriverProfile $driverProfile): bool
    {
        return $user->hasPermission('drivers.manage');
    }
}