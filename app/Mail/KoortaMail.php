<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KoortaMail extends Mailable
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
        return $this->markdown('mail.koortamail')
                    ->from('admin@kptis1.dinus.web.id')
                    ->subject('Koordinator TA Udinus')
                    ->with([
                        'email'     => $this->details,
                        'password'  => "dinuskp123"
                    ]);
    }
}
