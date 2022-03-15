<?php namespace App\Console\Commands;

use App\Models\DateConstraint;
use App\Notifications\SelectDateLaterOneDayEmail;
use App\Notifications\SelectDateLaterTwoWeeksEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendSelectDateLaterEmails extends Command
{
    use DispatchesJobs;

    public $proposedDates = [];

    protected $signature = 'send:selectdatelater';
    protected $description = 'Dispatches emails to users that haven\'t selected a date yet';

    private function _getUsers($days)
    {
        $date  = Carbon::today()->subDays($days)->toDateString();
        $users = User::where('pending_date_selection', 1)->whereDate('created_at', '=', $date)->get();

        return $users;
    }

    /**
     * Monday => Tuesday
     * Friday => Saturday
     * Check date constraints
     *
     * @param Carbon $date
     * @param int $region
     * @return bool
     */
    private function _proposedDateIsOk($date, $region)
    {
        if ($date->isMonday() || $date->isFriday()) return false;

        $constraintExists = DateConstraint::where('constrainable_type', 'App\Models\Region')
                                          ->where('constrainable_id', $region)
                                          ->where('from', '<=', $date->toDateString())
                                          ->where('to', '>=', $date->toDateString())
                                          ->exists();

        return !$constraintExists;
    }

    private function _calculateProposedDate($region)
    {
        $proposed = Carbon::today()->addDays(16);

        while (!$this->_proposedDateIsOk($proposed, $region)) {
            $proposed->addDay();
        }

        $this->proposedDates[$region] = $proposed;
    }

    private function _getProposed($region)
    {
        if (isset($this->proposedDates[$region]))
            return $this->proposedDates[$region];

        $this->_calculateProposedDate($region);

        return $this->proposedDates[$region];
    }

    private function _sendOneDayEmail()
    {
        $users = $this->_getUsers(1);

        foreach ($users as $user) {
            $proposed = $this->_getProposed($user->region_id);

            // Notify user
            $notification = new SelectDateLaterOneDayEmail($user, $proposed);
            $user->notify($notification);
        }
    }

    private function _sendTwoWeeksEmail()
    {
        $users = $this->_getUsers(14);

        foreach ($users as $user) {
            $proposed = $this->_getProposed($user->region_id);

            // Notify user
            $notification = new SelectDateLaterTwoWeeksEmail($user, $proposed);
            $user->notify($notification);
        }
    }

    public function handle()
    {
        for ($i = 1; $i < 12; $i++) {
            $this->_calculateProposedDate($i);
        }
        dd($this->proposedDates);
        $this->_sendOneDayEmail();
        $this->_sendTwoWeeksEmail();
    }
}