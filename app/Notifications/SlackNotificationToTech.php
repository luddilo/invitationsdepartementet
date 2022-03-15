<?php
namespace App\Notifications;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackNotificationToTech extends SlackNotification
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Leika', ':heart_eyes:')
            ->to('#tech')
            ->content($this->content);
    }
}
