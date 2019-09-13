<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jenssegers\Agent\Agent;

class OsInfoMail extends Mailable
{
    use Queueable, SerializesModels;



    public $agent;

    /**
     * Create a new message instance.
     *
     * @param \Jenssegers\Agent\Agent $agent
     */
    public function __construct(Agent $agent)
    {
        $this->agent=$agent ;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.osInfo');
    }
}
