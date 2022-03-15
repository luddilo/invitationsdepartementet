<?php
namespace App\Notifications;

abstract class SlackNotificationToRegionChannel extends SlackNotification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;

        if (!isset($this->user))
            throw new \InvalidArgumentException("No user given");
    }

    protected abstract function _getContent();

    protected function _getChannel()
    {
        $region = str_slug($this->user->region->name);

        if (in_array($region, ['malmo', 'stockholm'])) {
            $channel = $region;
        } else {
            $channel = 'ovriga_regioner';
        }

        return '#' . $channel;
    }

    public function prepareSlackMessage($notifiable)
    {
        $channel = $this->_getChannel();

        return parent::prepareSlackMessage($notifiable)->to($channel);
    }

    public function toSlack($notifiable)
    {
        $content = $this->_getContent();

        return $this->prepareSlackMessage($notifiable)->content($content);
    }
}
