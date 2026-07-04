<?php

// app/Providers/AppServiceProvider.php
namespace App\Providers;

use App\Events\LeadCreated;
use App\Listeners\NotifyAdminsOfNewLead;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(LeadCreated::class, NotifyAdminsOfNewLead::class);
        Gate::before(function ($user, string $ability) {
            return $user->hasPermission($ability) ?: null;
        });
    }
}