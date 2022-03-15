<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\User;
use App\Models\Dinner;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Libraries\EmailSender;

class SendFeedbackEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $feedbackUrl;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->feedbackUrl = env('TYPEFORM_URL_FEEDBACK') . '?fluent=%s&host=%s&counterpart=%s&name=%s&uuid=%s';
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
        $counterpart_name = User::findOrFail($data['counterpart_id'])->first_name;
        $data['counterpart'] = $counterpart_name;

        $fluent = $data['user']->fluent;
        $host = $data['recipient_type'] == 'host' ? 1 : 0;
        $name = $data['user']->first_name;
        $uuid = $data['user']->uuid;
        $dinner = Dinner::findOrFail($data['dinner_id']);

        $data['feedback_url'] = sprintf($this->feedbackUrl, $fluent, $host, urlencode($counterpart_name), urlencode($name), $uuid);

        $email_type = $data['email_type']; // Either 7 (sent day after) or 8 (sent retroactively)
        $result = EmailSender::sendEmailFromTemplate($email_type, $data);

        if ($result == true) {

            if ($data['recipient_type'] == 'host'){
                $dinner->setFeedbackEmailSent('host');
            }
            else {
                $dinner->setFeedbackEmailSent('guest');
            }

        }
    }
}
