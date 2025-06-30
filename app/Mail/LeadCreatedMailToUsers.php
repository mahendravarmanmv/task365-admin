<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue; // ✅ If using queues

class LeadCreatedMailToUsers extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;

    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    public function build()
    {
        return $this->subject('New Lead in Your Category')
                    ->view('emails.lead-to-users'); // ✅ Make sure this blade file exists
    }
}

