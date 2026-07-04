<?php

// app/Enums/LeadType.php
namespace App\Enums;

enum LeadType: string
{
    case Contact = 'contact';
    case Quote = 'quote';
    case RouteInquiry = 'route_inquiry';

    public function label(): string
    {
        return match ($this) {
            self::Contact => 'General Contact',
            self::Quote => 'Quote Request',
            self::RouteInquiry => 'Route Inquiry',
        };
    }
}