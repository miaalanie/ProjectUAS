<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SummaryPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;
    public $diagnosis;
    public $pdf;

    public function __construct($guest, $diagnosis, $pdf)
    {
        $this->guest = $guest;
        $this->diagnosis = $diagnosis;
        $this->pdf = $pdf;
    }   

    public function build()
    {
        return $this->subject('Summary Diagnosa - ' . $this->guest->name)
                    ->view('emails.summary-email')
                    ->attachData($this->pdf->output(), 'SummaryDiagnosa.pdf');
    }

   
}
