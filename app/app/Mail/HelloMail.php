<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @param string $pdfPath The path to the PDF file
     */
    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.hello')
            ->subject('Uprise Report')
            ->attach($this->pdfPath, ['as' => 'report.pdf', 'mime' => 'application/pdf']);
    }
}
