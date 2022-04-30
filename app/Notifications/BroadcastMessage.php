<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BroadcastMessage extends Notification
{
    use Queueable;

    protected $message;

    protected $fromUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $fromUser, $message)
    {
        $this->fromUser = $fromUser;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'from_user' => $this->fromUser->toArray(),
        ];
    }
}
