<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ContentStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly string $title, private readonly string $type, private readonly string $action, private readonly string $url, private readonly string $actor)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $prettyType = Str::title(str_replace('_', ' ', $this->type));
        return (new MailMessage)
            ->subject("{$prettyType} {$this->action}")
            ->greeting('Hello,')
            ->line("A {$prettyType} item was {$this->action} by {$this->actor}.")
            ->line('Title: ' . $this->title)
            ->action('View in admin', $this->url)
            ->line('If you did not expect this change, please review the activity log.');
    }
}
