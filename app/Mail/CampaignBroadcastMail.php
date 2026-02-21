<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignBroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectLine;
    public string $preview;
    public string $bodyHtml;
    public string $footerNote;

    public function __construct(string $subjectLine, string $preview, string $bodyHtml, string $footerNote = '')
    {
        $this->subjectLine = $subjectLine;
        $this->preview = $preview;
        $this->bodyHtml = $bodyHtml;
        $this->footerNote = $footerNote;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('emails.campaign-broadcast')
            ->with([
                'subjectLine' => $this->subjectLine,
                'preview' => $this->preview,
                'bodyHtml' => $this->bodyHtml,
                'footerNote' => $this->footerNote,
            ]);
    }
}
