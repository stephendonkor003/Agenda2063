<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCode extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly int $code)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Agenda 2063 verification code')
            ->line('Use the code below to complete your sign-in:')
            ->line('**' . $this->code . '**')
            ->line('This code expires in 10 minutes. If you did not request it, please contact an administrator.');
    }
}
