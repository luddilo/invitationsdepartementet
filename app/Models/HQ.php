<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

class HQ
{
    use Notifiable;

    public function routeNotificationForSlack()
    {
        return config('slack.endpoint');
    }
}