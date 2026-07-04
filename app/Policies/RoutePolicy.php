<?php

// app/Policies/RoutePolicy.php
namespace App\Policies;

use App\Models\Route; 
use App\Models\User;

class RoutePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
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