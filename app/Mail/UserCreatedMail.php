<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array  $details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail sending from Qasim')
                    ->view('emails.mail');

        // return $this->view('view.name');
        // return $this->subject('Welcome to our CMS')
        //         ->markdown('emails.user_created')
        //         ->with([
        //             'password' => $this->password,
        //         ]);
    }
}
