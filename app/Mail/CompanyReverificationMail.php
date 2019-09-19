<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompanyReverificationMail extends Mailable
{

    use Queueable,
        SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
            ->subject('Employer/Company "' . $this->data['company_name'] . '" has been registered on "' . config('app.name'))
            ->view('emails.company_registered_message')
            ->with(
                [
                    'name' => $this->data['company_name'],
                    'email' => $this->data['to_email'],
                    'link' => route('company.detail', $this->data['slug']),
                    'link_admin' => route('edit.company', ['id' => $this->data['id']])
                ]
            );
    }

}
