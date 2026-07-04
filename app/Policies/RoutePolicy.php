<?php

// app/Policies/RoutePolicy.php  (Route = a transport route model, not Laravel's router)
namespace App\Policies;

use App\Models\Route;
use App\Models\User;

class RoutePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // anyone authenticated can browse routes
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('routes.manage');
    }

    public function update(User $user, Route $route): bool
    {
        return $user->hasPermission('routes.manage');
    }

    public function delete(User $user, Route $route): bool
    {
        return $user->hasPermission('routes.manage');
    }
}