<?php

namespace App\Policies;

use App\Models\User;

class BookingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->hasPermission('bookings.manage');
    }
}
