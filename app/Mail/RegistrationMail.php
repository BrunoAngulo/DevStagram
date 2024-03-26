<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
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
        $htmlContent = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registro exitoso</title>
            </head>
            <body>
                <h1>Bienvenido, {$this->user->name}!</h1>
                <p>Tu registro en nuestra aplicación ha sido exitoso.</p>
                <p>Aquí tienes algunos detalles de tu cuenta:</p>
                <ul>
                    <li><strong>Usuario:</strong> {$this->user->email}</li>
                    <!-- Puedes agregar más detalles de la cuenta aquí según tus necesidades -->
                </ul>
                <p>¡Gracias por unirte a nosotros!</p>
            </body>
            </html>
            HTML;

        return $this->html($htmlContent)
                    ->subject('¡Bienvenido a nuestra aplicación!');
    }
}
