<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Lead;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeadNotificationToAdmin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;

    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    public function build()
    {
        return $this->subject('New Lead Submitted')
                    ->view('emails.lead-to-admin');
    }
}
