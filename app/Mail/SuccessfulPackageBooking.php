<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessfulPackageBooking extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $userInfo;

    public $transactionStatus;

    public $bookingInfo;

    public $packageInfo;

    public function __construct($userInfo, $transactionStatus, $bookingInfo, $packageInfo)
    {
        $this->userInfo = $userInfo;
        $this->transactionStatus = $transactionStatus;
        $this->bookingInfo = $bookingInfo;
        $this->packageInfo = $packageInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@kalifetravel.com','Kalife Travels and Tours')
                    ->subject('Successful Travel Package Booking')
                    ->markdown('emails.SuccessfulPackageBooking');
    }
}
