<?php

namespace App\Mail;

use App\Models\CampaignSignup;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AspirationDailyMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $aspiration;
    public CampaignSignup $subscriber;

    public function __construct(array $aspiration, CampaignSignup $subscriber)
    {
        $this->aspiration  = $aspiration;
        $this->subscriber  = $subscriber;
    }

    public function build(): static
    {
        $dayLabel = now()->format('l, d F Y');

        $subject = "Agenda 2063 — {$this->aspiration['label']}: {$this->aspiration['title']} | {$dayLabel}";

        return $this->subject($subject)
            ->view('emails.aspiration-daily')
            ->with([
                'aspiration'  => $this->aspiration,
                'subscriber'  => $this->subscriber,
                'dayLabel'    => $dayLabel,
                'allCount'    => 7,
            ]);
    }
}
