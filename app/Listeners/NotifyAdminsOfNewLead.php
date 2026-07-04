<?php

// app/Listeners/NotifyAdminsOfNewLead.php
namespace App\Listeners;

use App\Events\LeadCreated;
use App\Models\User;
use App\Notifications\NewLeadNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminsOfNewLead implements ShouldQueue
{
    public function handle(LeadCreated $event): void
    {
        $admins = User::whereHas('role', function ($query) {
            $query->whereIn('slug', ['super-admin', 'admin']);
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewLeadNotification($event->lead));
        }
    }
}