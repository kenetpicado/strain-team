<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterNotification extends Notification
{
    use Queueable;

    public $password;

    public function __construct($pasword = null)
    {
        $this->password = $pasword;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.from.noreply'), config('app.name'))
            ->subject('Bienvenido - ' . config('app.name'))
            ->view('emails.register', [
                'name' => explode(' ', $notifiable->name)[0],
                'email' => $notifiable->email,
                'password' => $this->password,
                'type' => explode("\\", get_class($notifiable))[2]
            ]);
    }
}
