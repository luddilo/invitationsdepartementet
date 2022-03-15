<?php namespace App\Libraries;

use App\Models\Dinner;
use App\Models\Match;


class MatchMaker {

    public function findMatchingDinners($user, $dinners){

        $guest = $this->__prepareUserForTest($user);

        // Prepare all dinners for tests and do initial exclusive test
        foreach ($dinners as $dinner){
            $this->__prepareDinnerForTest($dinner);
            $dinner->allowed = $this->_doExclusiveTests($dinner, $guest);
        }

        // Remove all disallowed guests
        $allowedDinners = $dinners->reject(function ($dinner) {
            return $dinner->allowed == false;
        });

        foreach ($allowedDinners as $dinner) {
            $dinner->matchScore = $this->_doScoringTests($dinner, $guest);
        }

        return $allowedDinners
            ->sortByDesc('matchScore');
        //take(config('constants.MAX_MATCHES_PER_DINNER'));
    }

    public function findMatches($dinner, $guests){

        $host = $this->__prepareUserForTest($dinner->user, true);
        $dinner = $this->__prepareDinnerForTest($dinner);

        // Prepare all users for matching tests and do exclusive tests
        foreach ($guests as $guest){
            $guest = $this->__prepareUserForTest($guest);
            $guest->allowed = $this->_doExclusiveTests($dinner, $guest);
        }

        // Remove all disallowed guests
        $allowedGuests = $guests->reject(function ($guest) {
            return $guest->allowed == false;
        });

        foreach ($allowedGuests as $guest) {
            $guest->matchScore = $this->_doScoringTests($dinner, $guest);
        }

        return $allowedGuests
            ->sortByDesc('matchScore')->
            take(config('constants.MAX_MATCHES_PER_DINNER'));
    }

    /*
     * PREPARATION FUNCTIONS
     */

    private function __prepareDinnerForTest($dinner){
        $dinner->hasSameGenderPartners = true; // Default
        foreach ($dinner->partners as $partner) {
            if ($dinner->user->gender != $partner->gender) {
                $dinner->hasSameGenderPartners = false;
                break;
            }
        }
        $dinner->hasChildren = count($dinner->children) > 0;
        return $dinner;
    }

    private function __prepareUserForTest($user, $is_host = false){
        $user->hasSameGenderPartners = true;
        foreach ($user->partners as $partner) {
            if ($user->gender != $partner->gender) {
                $user->hasSameGenderPartners = false;
                break;
            }
        }

        if($is_host){
            $user->is_host = true;
        }

        $user->hostedDinners = count(Dinner::where('user_id', $user->id)->where('has_match', 1)->get());
        $user->guestedDinners = count(Match::where('status_id', 2)->where('user_id', $user->id)->get());
        $user->hasGuestingPreferences = count($user->getGuestingPreferences()) > 0;
        $user->hasChildren = count($user->children) > 0;
        $user->hasHostingPreferences = count($user->getHostingPreferences()) > 0;

        return $user;
    }

    /*
     * SUMMARIZING FUNCTIONS
     */

    private function _doExclusiveTests($dinner, $guest)
    {


        if ($guest->is_host == false && $guest->getStatus() == 'has_pending_dinner') {
            return false;
        }
        if ($guest->hasActiveDateConstraint($dinner->date)) {
            return false;
        }

        if (!$this->__genderTest($guest, $dinner)){ // Gender test - checks if both host and guest has only same gender partners and are of different genders
            return false;
        }

        if (!$this->__preferencesTest($guest, $dinner->user)) {
            // Preferences test - checks if host and guest has intersecting (i.e clashing) preferences
            return false;

        }
        return true;
    }

    private function _doScoringTests($dinner, $guest){

        $normalizer =
            config('constants.WEIGHT_HISTORY') +
            config('constants.WEIGHT_DAY_AVAILABILITY') +
            config('constants.WEIGHT_QUANTITY') +
            config('constants.WEIGHT_CHILDREN');

        $availabilityScore = $this->__dayAvailabilityTest($guest, $dinner); // Day availablity test - checks if guest is available on this weekday
        $quantityScore = $this->__quantityTest($guest, $dinner); // Guest quantity test
        $childrenScore = $this->__childrenTest($guest, $dinner);   // Children age test
        $historyScore = $this->__historyTest($guest); // Dinner history test
        $score = ($availabilityScore +
                $quantityScore +
                $childrenScore +
                $historyScore)
            /
            $normalizer;

        return $score;
    }

    /*
     * TESTS
     */
    private function __genderTest($guest, $dinner){
        if ($dinner->hasSameGenderPartners && $guest->hasSameGenderPartners && $dinner->user->gender != $guest->gender){
            return false;
        }
        return true;
    }

    private function __preferencesTest($guest, $host){
        if ($host->hasHostingPreferences && $guest->hasGuestingPreferences) {
            if (count($host->getHostingPreferences()->intersect($guest->getGuestingPreferences())) > 0) {
                return false;
            }
        }
        return true;
    }

    private function __historyTest($guest){
        switch ($guest->getStatus()){
            case 'has_pending_dinner': // We have already filtered out this, but anyway..
                $result = 0;
                break;
            case 'has_hosted_dinner':
                $result = 50;
                break;
            case 'has_guested_dinner':
                $result = 50;
                break;
            case 'has_not_been_to_dinner':
                $result = 100;
                break;
            default:
                $result = 0;
                break;
        }
        return $result * config('constants.WEIGHT_HISTORY');
    }

    private function __dayAvailabilityTest($guest, $dinner){
        $guestDatePreferences = $guest->datepreferences()->pluck('day_id');

        if ($guestDatePreferences->contains(-1) ||  // All days acceptable
            $guestDatePreferences->contains(date('w', strtotime($dinner->date))) || // This day is acceptable
            count($guest->datepreferences) == 0)  // Day is not set
        {
            $result = 100;
        }
        else {
            $result = 0;
        }
        return $result * config('constants.WEIGHT_DAY_AVAILABILITY');
    }

    private function __quantityTest($guest, $dinner){
        $result = 0;
        switch ($dinner->guests) {
            case 1:
                if (count($guest->partners) <= 1 && count($guest->children) == 0)
                    $result = 100;
                break;
            case 2:
                if (count($guest->partners) == 1 && count($guest->children) > 1)
                    $result = 100;
                break;
            case 3:
                if (count($guest->partners) > 1)
                    $result = 100;
                break;
            default:
                $result =  0;
                break;
        }
        return $result * config('constants.WEIGHT_QUANTITY');
    }

    private function __childrenTest($guest, $dinner){
        if ($guest->hasChildren && $dinner->hasChildren) {
            $local_min = 99;
            $local_max = 0;
            foreach ($dinner->children as $host_child) {
                foreach ($guest->children as $guest_child) {
                    $diff = abs($guest_child->age - $host_child->age);
                    if ($diff < $local_min) {
                        $local_min = $diff;
                    }
                }
                if ($local_min > $local_max) {
                    $local_max = $local_min;
                }
            }
            $x = $local_max;
            $result = -0.1164 * pow($x, 3) + 3.6295 * pow($x, 2) - 37.753 * $x + 100;
        }
        else {
            $result = 0;
        }
        return $result < 0 ? 0 : $result * config('constants.WEIGHT_CHILDREN');
    }
}