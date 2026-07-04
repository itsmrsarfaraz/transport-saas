<?php

// app/Notifications/NewLeadNotification.php
namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Lead $lead)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Lead: '.$this->lead->type->label())
            ->line('A new lead has come in.')
            ->line('Name: '.$this->lead->name)
            ->line('Email: '.$this->lead->email)
            ->when($this->lead->message, fn ($mail) => $mail->line('Message: '.$this->lead->message))
            ->action('View Lead', url('/admin/leads/'.$this->lead->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'lead_id' => $this->lead->id,
            'type' => $this->lead->type->value,
            'name' => $this->lead->name,
        ];
    }
}