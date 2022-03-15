<?php

namespace App\Console\Commands;

use App\Models\HQ;
use App\Notifications\SlackNotificationToTech;
use Illuminate\Console\Command;
use App\Models\Dinner;
use App\Jobs\SendFeedbackEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendFeedbackAfterDinnerEmails extends Command
{
    use DispatchesJobs;
    /**
     * Create a new command instance.
     *
     * @return void
     */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send feedback emails to all dinners the previous day';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $yesterday = date('Y-m-d', strtotime('-1 days'));

        $dinners = Dinner::where('date', $yesterday)->matched()->withoutFeedback()->with('matches')->get();

        $this->comment("Found " . count($dinners) . " dinners for feedback emails");

        foreach ($dinners as $dinner) {
            $host = $dinner->user;

            // Only send feedback emails to people is a region that has dateselection
            if (!$host->region->user_dateselection) {
                $this->comment("Ruled email out since not in region with dateselection");
                continue;
            }

            $guest = $dinner->acceptedGuest();
            $sending_to = [];

            if ($dinner->feedback_status_host == 0) {
                $email_to_host = new SendFeedbackEmail([
                    'email_type' => 7,
                    'recipient_type' => 'host',
                    'dinner_id' => $dinner->id,
                    'user_id' => $host->id,
                    'counterpart_id' => $guest->id,
                ]);
                $sending_to[] = $host->email;
                $this->comment("User " . $host->id . " will now get a host email");

                $this->dispatch($email_to_host);
            }

            if ($dinner->feedback_status_guest == 0) {
                $email_to_guest = new SendFeedbackEmail([
                    'email_type' => 7,
                    'recipient_type' => 'guest',
                    'dinner_id' => $dinner->id,
                    'user_id' => $guest->id,
                    'counterpart_id' => $host->id,
                ]);
                $sending_to[] = $guest->email;
                $this->comment("User " . $guest->id . " will now get a guest email");

                $this->dispatch($email_to_guest);
            }

            $notification = new SlackNotificationToTech('Sending feedback-email to ' . implode(', ', $sending_to));
            \Notification::send(new HQ, $notification);
        }

    }
}
