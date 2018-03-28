<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentPreNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $amount;

    public $userInfo;

    public $reference;

    public function __construct($userInfo, $amount, $reference)
    {
        $this->userInfo = $userInfo;
        $this->amount= $amount;
        $this->reference = $reference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@kalifetravel.com','Kalife Travels and Tours')
                     ->subject('Pre Payment Notification')
                     ->markdown('emails.PaymentPreNotification');
    }
}
