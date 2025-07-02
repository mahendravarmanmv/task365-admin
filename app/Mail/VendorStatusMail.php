<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $status;

    public function __construct($vendor, $status)
    {
        $this->vendor = $vendor;
        $this->status = $status;
    }

    public function build()
    {
        if ($this->status === 'rejected') {
            return $this->subject('Action Required: Complete Your Vendor Profile on Task365')
                        ->view('emails.vendor.rejected')
                        ->with(['vendor' => $this->vendor]);
        }

        $subject = match ($this->status) {
            'approved' => 'Your Vendor Account is Approved',
            'blocked' => 'Your Vendor Account is Blocked',
            default => 'Vendor Status Update',
        };

        return $this->subject($subject)
                    ->view('emails.vendor.status')
                    ->with([
                        'vendor' => $this->vendor,
                        'status' => $this->status,
                    ]);
    }
}

