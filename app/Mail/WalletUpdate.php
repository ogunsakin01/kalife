<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WalletUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $userInfo;

    public $amount;

    public $type;

    public function __construct($userInfo, $amount, $type)
    {
        $this->amount   = $amount;
        $this->userInfo = $userInfo;
        $this->type     = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@KalifeTravelsandTours.com','Kalife Travels and Tours')
            ->markdown('emails.WalletUpdate');
    }
}
