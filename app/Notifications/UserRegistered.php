<?php
namespace App\Notifications;

class UserRegistered extends SlackNotificationToRegionChannel
{
    protected function _getContent()
    {
        $text = $this->user->getFullName() . ' (' . $this->user->email .
            ') registrerade sig precis (REGION: ' . $this->user->region->name . ')';

        return $text;
    }
}
