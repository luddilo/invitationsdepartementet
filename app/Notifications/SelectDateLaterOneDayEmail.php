<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class SelectDateLaterOneDayEmail extends EmailNotification
{
    public $user;
    public $proposedDate;

    /**
     * Create a new notification instance.
     * @param $user
     * @param $proposedDate
     */
    public function __construct($user, $proposedDate)
    {
        $this->user = $user;
        $this->proposedDate = $proposedDate;
    }

    protected function _registerInDB()
    {
        parent::registerInDB([
            'user' => $this->user,
            ''
        ]);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $this->_registerInDB();

        return (new MailMessage)
            ->subject('Datumförslag för din middag')
            ->markdown('emails.reminder_oneday', ['user'=> $this->user, 'proposed' => $this->proposedDate]);
    }
}
