<?php
namespace App\Notifications;

class UserSelectedDate extends SlackNotificationToRegionChannel
{
    protected $dinner;

    public function __construct($user, $dinner)
    {
        parent::__construct($user);

        $this->dinner = $dinner;
    }

    protected function _getContent()
    {
        $url  = route('app.dinners.show', $this->dinner->id);
        $text = $this->user->getFullName() . ' skapade precis en middagsförfrågan: ' . $url;

        return $text;
    }

}
