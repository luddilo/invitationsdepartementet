<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;

class SelectDateLaterTwoWeeksEmail extends EmailNotification
{
    public $user;
    public $proposedDate;

    /**
     * Create a new notification instance.
     * @param $user
     * @param Carbon $proposed
     */
    public function __construct($user, $proposed)
    {
        $this->user = $user;
        $this->proposedDate = $proposed;
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
            ->subject('Middag är BÄST')
            ->markdown('emails.reminder_twoweeks', ['user' => $this->user, 'proposed' => $this->proposedDate]);
    }
}
