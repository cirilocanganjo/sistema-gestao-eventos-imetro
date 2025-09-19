<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $recoverPasswordCode;

    public function __construct($recoverPasswordCode)
    {
        $this->recoverPasswordCode = $recoverPasswordCode;
    }    
    

    public function build()
    {
        return $this->view('emails.user.recover-password')
        ->subject('Recuperação de Senha')
        ->with(['code' => $this->recoverPasswordCode]);
    }   

}
