<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $user
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
        $htmlContent = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Inicio de sesión exitoso</title>
            </head>
            <body>
                <h1>Bienvenido de vuelta, {$this->user->name}!</h1>
                <p>Tu inicio de sesión en nuestra aplicación ha sido exitoso.</p>
                <p>Aquí tienes algunos detalles de tu sesión:</p>
                <ul>
                    <li><strong>Usuario:</strong> {$this->user->email}</li>
                    <li><strong>Hora del inicio de sesión:</strong> {$this->getCurrentTime()}</li>
                </ul>
                
                <!-- Inserta la imagen -->
                <img src="https://example.com/images/logo.png" alt="Logo de la aplicación">
                
                <p>¡Gracias por usar nuestra aplicación!</p>
            </body>
            </html>
            HTML;
        return $this->html($htmlContent)
                    ->subject('Asunto del correo electrónico');
    }

    /**
     * Get current time formatted.
     *
     * @return string
     */
    protected function getCurrentTime()
    {
        return now()->format('Y-m-d H:i:s');
    }
}
