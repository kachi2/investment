<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class UserVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
     
        $this->user = $user;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */

  
    public function build()
    {
      
        return $this->subject('Email verification')->from('support@theadventcapital.com')->view('emails.users.email-verify')->with('user', $this->user);
    }
}
