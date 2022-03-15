<?php

namespace App\Notifications;

use App\Libraries\Repositories\EmailRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

abstract class EmailNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param $data
     * @return mixed
     */
    public function registerInDB($data)
    {
        $repository = app()->make(EmailRepository::class);
        $email = $repository->create($data);
        return $email;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    abstract public function toMail($notifiable);
}
