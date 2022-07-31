<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

use App\Enums\EmailRecipientType;
use App\Enums\EmailTemplateStatus;
use App\Enums\UserRoles;
use App\Mail\SendEmail;
use App\Models\EmailTemplate;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
class UserVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $slug;
    private $order;
    private $mailTo;
    private $others;
    private $catchs;
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
      
        return $this->subject('Email verification')->from('support@mazeoptions.com')->view('emails.users.email-verify')->with('user', $this->user);
    }
}
