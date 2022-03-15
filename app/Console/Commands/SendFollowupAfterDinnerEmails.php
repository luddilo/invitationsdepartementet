<?php

namespace App\Console\Commands;

use App\Models\HQ;
use App\Notifications\SlackNotificationToTech;
use Illuminate\Console\Command;
use App\Models\Dinner;
use App\Jobs\SendFollowupEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendFollowupAfterDinnerEmails extends Command
{
    use DispatchesJobs;

    protected $signature = 'feedback:followup_send';
    protected $description = 'Send followup emails to all dinners 2 months (60 days) earlier';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d', strtotime('-60 days'));
        $dinners = Dinner::where('date', $date)->matched()->withoutFollowup()->with('user')->with('matches')->get();

        $this->comment("Queued " . count($dinners) . " dinners for followup emails");

        foreach ($dinners as $dinner) {
            $host = $dinner->user;

            // Only send followup emails to people is a region that has dateselection
            if (!$host->region->user_dateselection) {
                $this->comment("Ruled email out since not in region with dateselection");
                continue;
            }

            $guest = $dinner->acceptedGuest();
            $sending_to = [];

            if ($dinner->followup_status_host == 0) {
                $email_to_host = new SendFollowupEmail([
                    'recipient_type' => 'host',
                    'dinner_id' => $dinner->id,
                    'user_id' => $host->id,
                    'counterpart_id' => $guest->id

                ]);

                $sending_to[] = $host->email;
                $this->comment("User " . $host->id . " will now get a host FOLLOWUP email");

                $this->dispatch($email_to_host);
            }

            if ($dinner->followup_status_guest == 0) {
                $email_to_guest = new SendFollowupEmail([
                    'recipient_type' => 'guest',
                    'dinner_id' => $dinner->id,
                    'user_id' => $guest->id,
                    'counterpart_id' => $host->id
                ]);

                $sending_to[] = $guest->email;
                $this->comment("User " . $guest->id . " will now get a guest FOLLOWUP email");

                $this->dispatch($email_to_guest);
            }

            $notification = new SlackNotificationToTech('Sending followup-email to ' . implode(', ', $sending_to));
            \Notification::send(new HQ, $notification);
        }

    }
}
