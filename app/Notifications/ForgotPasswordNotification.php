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
            ->from(config('mail.from.noreply'), config('app.name'))
            ->subject('Restablecer contraseña - ' . config('app.name'))
            ->view('emails.forgot-password', [
                'name' => explode(' ', $notifiable->name)[0],
                'password' => $this->password,
            ]);
    }
}
