<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\User;
use App\Models\Dinner;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Libraries\EmailSender;

class SendFollowupEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;
    private $followupUrl;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->followupUrl = env('TYPEFORM_URL_FOLLOWUP') . '?name=%s&counterpart=%s&uuid=%s';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        $data['user'] = User::findOrFail($data['user_id']);

        $name = $data['user']->first_name;
        $data['counterpart'] = User::findOrFail($data['counterpart_id'])->first_name;
        $uuid = $data['user']->uuid;

        $data['followup_url'] = sprintf($this->followupUrl, urlencode($name), urlencode($data['counterpart']), $uuid);

        $email_type = 8; // Followup email type. See constants.php
        $result = EmailSender::sendEmailFromTemplate($email_type, $data);

        if ($result == true){
            $dinner = Dinner::findOrFail($data['dinner_id']);

            if ($data['recipient_type'] == 'guest'){
                $dinner->setFollowupEmailSent('guest');
            }
            else {
                $dinner->setFollowupEmailSent('host');
            }

        }
    }
}
