<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dinner;
use App\Jobs\SendFeedbackEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendFeedbackRetroactively extends Command
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
    protected $signature = 'feedback:retroactively';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send feedback emails to dinners retroactively';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start_date = '2016-12-11';
        $stop_date = '2017-02-01';
        $dinners = Dinner::where('date', '>=', $start_date)->where('date', '<=', $stop_date)->matched()->withoutFeedback()->with('matches')->get();

        $this->comment("Found " . count($dinners) . " dinners for RETROACTIVE feedback emails");

        foreach ($dinners as $dinner) {
            $host = $dinner->user;

            // Only send feedback emails to people is a region that has dateselection
            if ($host->region->user_dateselection) {

                $guest = $dinner->acceptedGuest();

                if ($dinner->feedback_status_host == 0) {
                    $email_to_host = new SendFeedbackEmail([
                        'email_type' => 8,
                        'recipient_type' => 'host',
                        'dinner_id' => $dinner->id,
                        'user_id' => $host->id,
                        'counterpart_id' => $guest->id

                    ]);
                    $this->comment("User " . $host->id . " will now get a RETROACTIVE host email");

                    $this->dispatch($email_to_host);
                }

                if ($dinner->feedback_status_guest == 0) {
                    $email_to_guest = new SendFeedbackEmail([
                        'email_type' => 8,
                        'recipient_type' => 'guest',
                        'dinner_id' => $dinner->id,
                        'user_id' => $guest->id,
                        'counterpart_id' => $host->id
                    ]);
                    $this->comment("User " . $guest->id . " will now get a RETROACTIVE guest email");

                    $this->dispatch($email_to_guest);
                }
            }
            else {
                $this->comment("Ruled email out since not in region with dateselection");
            }
        }

    }
}
