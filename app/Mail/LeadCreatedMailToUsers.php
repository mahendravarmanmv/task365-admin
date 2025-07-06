<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class LeadCreatedMailToUsers extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($lead, User $user)
    {
        $this->lead = $lead;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Lead Generated from Your Task365.in "Lead ID: ' . $this->lead->lead_unique_id . '"')
                    ->view('emails.lead-to-users')
                    ->with([
                        'lead' => $this->lead,
                        'vendor_name' => $this->user->name ?? 'Vendor',
                        'lead_url' => url('/leads/' . $this->lead->id),
                    ]);
    }
}
