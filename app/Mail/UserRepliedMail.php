<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRepliedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($issue)
    {
        $this->issue = $issue;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = new NewUserRepliedMail($this->issue);

        return $this->view('emails.userReplied')->with('issue', $this->issue);
    }
}
