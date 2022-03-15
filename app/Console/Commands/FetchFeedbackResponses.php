<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Feedback;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FetchFeedbackResponses extends Command
{
    use DispatchesJobs;

    protected $signature = 'feedback:fetch';

    private $earliest_start = '2016-08-01 00:00:00';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch feedback responses';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url_feedback = 'https://api.typeform.com/v1/form/CHlLda?key=%s&completed=true&since=%s';
        $this->_fetchFeedback('DAY_AFTER_DINNER', $url_feedback);

        //$url_followup = 'https://api.typeform.com/v1/form/CHlLda?key=%s&completed=true&since=%s';
        //$this->_fetchFeedback('FOLLOWUP', $url_followup);
    }

    private function _fetchFeedback($type, $url){

        // details details
        $earliest_start = $this->earliest_start;
        $last_feedback = $type == 'DAY_AFTER_DINNER' ? Feedback::dayAfterDinner()->get()->last() : Feedback::followups()->get()->last();
        $latest_fetch = strtotime($last_feedback ? $last_feedback->created_at : $earliest_start); // We only want to pick up new answers, if no answers are recorded we take all from a certain date

        $apiKey = env('TYPEFORM_KEY');

        // Populate url and fetch results
        $populatedUrl = sprintf($url, $apiKey, $latest_fetch);
        $result = json_decode(file_get_contents($populatedUrl));

        if ($result->http_status != 200){
            $this->comment('error');
            return;
        }

        $questions = $result->questions;

        foreach ($result->responses as $response){

            // Populate the data
            $data = [
                'metadata' => $response->metadata,
                'questions' => $questions,
                'answers' => $response->answers
            ];

            $user_id = 45;// get it;
            $dinner_id = 10;// get it;

            // Create feedback
            $feedback = new Feedback([
                'type' => $type,
                'date' => $response->metadata->date_submit,
                'user_id' => $user_id,
                'feedbackable_id' => $dinner_id,
                'feedbackable_type' => 'App\Models\Dinner',
                'data' => $data
            ]);

            $feedback->save();

            // Mark feedback as received
            $feedback->feedbackable->setFeedbackReceived($user_id);

            break;
        }
    }
}
