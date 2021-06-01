<?php

namespace App\Mail;

use App\Models\Koorkp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KoorkpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.koorkpmail')
                    ->from('admin@kptis1.dinus.web.id')
                    ->subject('Koordinator KP Udinus')
                    ->with([
                        'email'     => $this->details,
                        'password'  => "dinuskp123"
                    ]);
    }
}
