<?php namespace App\Libraries\Repositories;

use App\Models\Datepreference;
use App\Models\User;
use App\Models\Partner;
use App\Models\Child;
use App\Models\Dinner;
use App\Models\Match;
use App\Models\Role;
use App\Models\Region;
use App\Models\Referrer;
use App\Models\Note;
use App\Models\School;
use App\Models\Address;
use App\Http\Controllers\Auth;
use App\Libraries\MatchMaker;
use App\Libraries\Repositories\BaseRepository;
use App\Libraries\Helpers;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserRepository extends BaseRepository
{

    /**
    * Configure the Model
    *
    **/
    public function model()
    {
      return 'App\Models\User';
    }

	public function search($input)
    {
        $query = User::query();

        $columns = Schema::getColumnListing('users');
        $attributes = array();

        foreach($columns as $attribute)
        {
            if(isset($input[$attribute]) and !empty($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] = $input[$attribute];
            }
            else
            {
                $attributes[$attribute] =  null;
            }
        }

        return [$query->get(), $attributes];
    }

    public function apiFindOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "User not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "User not found");
        }

        return $model->delete();
    }

    public function getAll() {
        return User::all();
    }

    public function getByRegion($region = null){
        if ($region == null){
            $region = \Auth::user()->getRegion()->name;
        }
        return User::whereHas('region', function($query) use($region) {
            $query->where('name', $region);
        });
    }

    public function getByRole($role){

        return User::whereHas('roles', function($query) use($role) {
            $query->where('name', $role);
        });
    }

    public function getByRoleAndRegion($role, $region = null) {

        if ($region == null){
            $region = \Auth::user()->getRegion()->name;
        }
        return User::active()->whereHas('region', function($query) use($region) {
                $query->where('name', $region);
            })
            ->whereHas('roles', function($query) use($role) {
                $query->where('name', $role);
            });
    }

    public function getByRoleFluencyRegion($role, $fluency, $region = null) {

        if ($region == null){
            $region = \Auth::user()->getRegion()->name;
        }

        $users =
            User::active()->whereHas('region', function($query) use($region) {
                $query->where('name', $region);
            })
            ->whereHas('roles', function($query) use($role) {
                $query->where('name', $role);
            })
            ->where('fluent', $fluency);

        return $users;
    }

    public function getGuestsSignedUpOnWeb($region){
        $users =
            User::active()->where('wants_to_host', 0)
                ->where('wants_to_guest', 1)
                //->where('created_by', '!=', 0)
                ->whereHas('region', function($query) use($region) {
                    $query->where('name', $region);
                })
                ->whereDoesntHave('matches', function($query) {
                    $query->where('status_id', 2);
                })
                ->whereDoesntHave('dinners', function($query) {
                    $query->where('has_match', 1);
                });

        return $users;
    }

    public function createAndAssign($input){

        $input['uuid'] = Helpers::uuid();
        $input['phone'] = str_replace(' ', '', $input['phone']);
        $user = $this->create($input);
        $this->assignRelations($user, $input);

        return $user;
    }

    public function updateAndReassign($user_id, $input){
        $this->updateRich($input, $user_id);
        $user = $this->find($user_id);
        $this->assignRelations($user, $input);
    }

    public function assignRelations($user, $input){
        $this->assignChildren($user, $input);
        $this->assignPartners($user, $input);
        $this->assignNotes($user, $input);
        $this->assignRegion($user, $input);
        $this->assignSchool($user, $input);
        $this->assignRoles($user, $input);
        $this->assignDatepreferences($user, $input);
        $this->assignPreferences($user, $input);
        $this->assignAddress($user, $input);
        $this->assignReferrer($user, $input);
    }

    public function assignPartners($user, $input){
        if (array_key_exists('partner_gender', $input)){
            $partner_genders = $input['partner_gender'];
            $user->partners()->delete();
            foreach ($partner_genders as $gender) {
                $partner = new Partner(['gender' => $gender]);
                $user->partners()->save($partner);
            }
        }
        else if (count($user->partners) > 0){
            $user->partners()->delete();
        }
    }

    public function assignChildren($user, $input){
        if (array_key_exists('children_age', $input)){
            $children_ages = $input['children_age'];
            $user->children()->delete();
            foreach ($children_ages as $age){
                $child = new Child(['age' => $age]);
                $user->children()->save($child);
            }
        }
        else if (count($user->children) > 0){
            $user->children()->delete();
        }
    }

    public function assignRoles($user, $input){
        // Assign role
        if (array_key_exists('role_list', $input)){
            $roles_ids = $input['role_list'];
            $user->roles()->sync($roles_ids);

            return Role::find(array_pop($roles_ids));
        }
    }

    public function assignRegion($user, $input) {
        if (array_key_exists('region_id', $input)){
            $region = Region::find(intval($input['region_id']));
            $user->region()->associate($region);
            $user->save();
        }
    }

    public function assignReferrer($user, $input) {
        if (array_key_exists('referrer_id', $input)){
            $referrer = Referrer::find(intval($input['referrer_id']));
            $user->referrer()->associate($referrer);
            $user->save();
        }
    }

    public function assignSchool($user, $input) {
        if (array_key_exists('school_id', $input)){
            $school = School::find(intval($input['school_id']));
            $user->school()->associate($school);
            $user->save();
        }
    }


    public function assignDatepreferences($user, $input) {
        // Assign datepreferences
        if (array_key_exists('datepreference_list', $input)){
            $preferences_ids = $input['datepreference_list'];
            $user->datepreferences()->delete();
            foreach ($preferences_ids as $preferenceId) {
                $preference = new Datepreference([
                    'day_id' => $preferenceId
                ]);
                $user->datepreferences()->save($preference);
            }
        }
        else {
            $user->datepreferences()->delete();
        }
    }

    public function assignPreferences($user, $input) {
        // Assign preferences
        $user->preferences()->detach();
        $preferences = array();
        if (array_key_exists('preference_list_hosting', $input)){
            $preferences_ids = $input['preference_list_hosting'];
            foreach ($preferences_ids as $preference_id) {
                $preferences[$preference_id] = ['guesting' => false];
            }
        }
        if (array_key_exists('preference_list_guesting', $input)){
            $preferences_ids = $input['preference_list_guesting'];
            foreach ($preferences_ids as $preference_id) {
                $preferences[$preference_id] = ['guesting' => true];
            }
        }
        if (count($preferences) > 0){
            $user->preferences()->sync($preferences);
        }
    }

    public function assignAddress($user, $input) {
        if (array_key_exists('address_city', $input)){
            $address = $user->address;
            if (!$address) {
                $address = new Address();
            }

            $address->street = array_key_exists('address_street', $input) ? $input['address_street'] : '';
            $address->zipcode = array_key_exists('address_zip',$input) ? $input['address_zip'] : '';
            $address->city =  array_key_exists('address_city',$input) ? $input['address_city'] : '';
            $address->country =  array_key_exists('address_country',$input) ? $input['address_country'] : 'SE';

            $user->address()->save($address);
        }
    }

    public function assignNotes($user, $input){
        if (array_key_exists('note', $input)){
            $note = new Note([
                'content' => $input['note'],
                'author_id' => \Auth::user()->id
            ]);
            $user->notes()->save($note);
        }
    }

    public function getNewMatchesForDinner($id) {
        $dinner = Dinner::findOrFail($id);
        if (count($dinner->matches()->get()) > 0) {
            $dinner->setMatchFound(false);
            $dinner->matches()->delete();
        }
        $this->getMatchesForDinner($id, $dinner);
    }

    public function getMatchesForDinner($id, $dinner = null) {

        if (!$dinner){
            $dinner = Dinner::findOrFail($id);
        }
        // If matches exist, we return them (as collection so that we can reuse template)
        if ($dinner->hasAcceptedMatch()){
            return collect([$dinner->acceptedMatch()]);
        }
        else {
            // If no matches, we find some matches and return them
            $matchFluency = !$dinner->user->fluent; // Matches should be opposite fluency
            $guests = $this->getByRoleFluencyRegion('Member', $matchFluency)->where('wants_to_guest', true)->get();

            // Get matches from our MatchMaker Library
            $matchMaker = new MatchMaker();
            $matchingUsers = $matchMaker->findMatches($dinner, $guests);
            $matches = [];

            foreach ($matchingUsers as $matchedUser) {
                // Reuse existing matches of the dinner, host, guest combination
                $matches[] = $this->_createOrReturnMatch($dinner, $matchedUser, $matchedUser->matchScore);
            }
        }

        return collect([$matches])->sortBy('match_score');
    }

    public function getMatchesForUser($id, $user){
        if (!$user){
            $user = User::findOrFail($id);
        }

        $matchFluency = !$user->fluent; // Matches should be opposite fluency

        // Get dinners matching the users fluency, region and without approved matches
        $dinners = Dinner::whereHas('user', function($query) use($user, $matchFluency) {
            return $query->where('region_id', $user->region->id)
                ->where('fluent', $matchFluency);
        })->active()->withoutMatches()->get();

        // Get matches from our MatchMaker Library
        $matchMaker = new MatchMaker();
        $matchingDinners = $matchMaker->findMatchingDinners($user, $dinners);
        $matches = [];

        foreach ($matchingDinners as $matchedDinner) {
            $matches[] = $this->_createOrReturnMatch($matchedDinner, $user, $matchedDinner->matchScore);
        }

        return collect($matches);
    }

    protected function _createOrReturnMatch($dinner, $user, $score){
        $match = Match::where('dinner_id', $dinner->id)->where('user_id', $user->id)->first();
        if (is_null($match)){
            $match = new Match([
                'match_score' => $score
            ]);
            // Associate match to user
            $match->user()->associate($user);
            // Associate match to dinner
            $dinner->matches()->save($match);
            $match->reset();
        }
        return $match;
    }
}
