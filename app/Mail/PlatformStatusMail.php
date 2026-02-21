<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlatformStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $reportData;

    public function __construct(array $reportData)
    {
        $this->reportData = $reportData;
    }

    public function build(): static
    {
        $subject = 'Agenda 2063 Platform Status Report — '
            . $this->reportData['generated_at']->format('d M Y · H:i \U\T\C');

        return $this->subject($subject)
            ->view('emails.platform-status')
            ->with(['d' => $this->reportData]);
    }
}
