<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPasswordNotification extends Notification
{
    use Queueable;

    public $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('noreply@strainteam.com', config('app.name'))
            ->subject(config('app.name') . ' - Restablecer contraseña')
            ->view('emails.forgot-password', [
                'name' => explode(' ', $notifiable->name)[0],
                'password' => $this->password,
            ]);
    }
}
