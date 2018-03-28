<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessfulFlightBooking extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $bookingInfo;

    public $userInfo;

    public $transactionStatus;

    public function __construct($userInfo, $transactionStatus, $bookingInfo)
    {
        $this->userInfo = $userInfo;
        $this->transactionStatus = $transactionStatus;
        $this->bookingInfo = $bookingInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@kalifetravel.com','Kalife Travels and Tours')
                    ->subject('Successful Flight Booking')
                    ->markdown('emails.SuccessfulFlightBooking');
    }
}
