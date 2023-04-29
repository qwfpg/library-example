<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewEmployeeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private User $user;
    private string $url;

    public function __construct(User $user, string $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('You have been added as a new employee.')
            ->action('Sign in', $this->url)
            ->line('Thank you for using our app!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
