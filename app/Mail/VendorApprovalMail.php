<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $statusMessage;

    public function __construct($vendor, $statusMessage)
    {
        $this->vendor = $vendor;
        $this->statusMessage = $statusMessage;
    }

    public function build()
    {
        return $this->subject('Vendor Status Update')
                    ->view('emails.vendor_status');
    }
}
