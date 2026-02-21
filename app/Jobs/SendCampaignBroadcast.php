<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignBroadcastMail;

class SendCampaignBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $emails;
    public array $payload;

    public function __construct(array $emails, array $payload)
    {
        $this->emails = $emails;
        $this->payload = $payload;
    }

    public function handle(): void
    {
        foreach ($this->emails as $email) {
            Mail::to($email)->send(new CampaignBroadcastMail(
                $this->payload['subject'],
                $this->payload['preview'] ?? '',
                $this->payload['body_html'],
                $this->payload['footer'] ?? ''
            ));
        }
    }
}
