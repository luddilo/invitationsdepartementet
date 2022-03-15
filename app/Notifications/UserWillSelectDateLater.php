<?php
namespace App\Notifications;

class UserWillSelectDateLater extends SlackNotificationToRegionChannel
{
    protected function _getContent()
    {
        $text = $this->user->getFullName() . ' (' . $this->user->email .
            ') valde att välja datum senare. (REGION: ' . $this->user->region->name . ')';

        return $text;
    }

}
