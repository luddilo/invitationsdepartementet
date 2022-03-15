<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Libraries\EmailSender;

class SendAdminEmailNotificationForNewDinner extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->data['user'];
        $content = sprintf('Hej, jag skulle vilja hålla ytterligare en middag. <br><br>MVH,<br>%s<br>%s', $user->getFullName(), $user->email);
        $content = '[Detta mail skickades automatiskt då användaren anmält sig igen via webben]<br><br>' . $content;
        $data = [
            'recipient_email' => $this->data['recipient_email'],
            'sender' => $user,
            'title' => 'Jag vill hålla ytterligare en middag',
            'content' => $content
        ];
        EmailSender::sendAdminEmailFromUser($data);
    }
}
