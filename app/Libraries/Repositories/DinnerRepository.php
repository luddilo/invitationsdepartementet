<?php namespace App\Libraries\Repositories;

use App\Models\User;
use App\Models\Region;
use App\Models\Partner;
use App\Models\Child;
use App\Models\Dinner;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Repositories\BaseRepository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DinnerRepository extends BaseRepository
{

    /**
    * Configure the Model
    *
    **/
    public function model()
    {
      return 'App\Models\Dinner';
    }

	public function search($input)
    {
        $query = Dinner::query();

        $columns = Schema::getColumnListing('dinners');
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
            throw new HttpException(1001, "Dinner not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "Dinner not found");
        }

        return $model->delete();
    }

    public function activate($id){
        $model = $this->find($id);
        $model->setStatus('active');
    }

    public function cancel($id){
        $model = $this->find($id);
        $model->setStatus('cancelled');
    }

    public function getDinnersForCalendar($region, $from, $to)
    {
        $dinners = $this->addAdditionalData(
            $region->dinners()
                ->whereDate('date', '>=', $from)
                ->whereDate('date', '<=', $to)
                ->with(['user', 'user.children', 'user.partners'])
                ->with(['partners'])
                ->with(['children'])
                ->with(['matches', 'matches.user', 'matches.user.children', 'matches.user.partners'])
                ->with(['address'])
                ->get()
        );

        $formatted = [];

        foreach ($dinners as $dinner) {
            $formatted[] = [
                'title' => $dinner->title,
                'start' => $dinner->date,
                'url' => route('app.dinners.show', $dinner->id),
                'color' => $dinner->color,
            ];
        }

        return $formatted;
    }

    public function getDinners($region){

        $dinners = $this->addAdditionalData(
            $region->dinners()
                ->with(['user', 'user.children', 'user.partners'])
                ->with(['partners'])
                ->with(['children'])
                ->with(['matches', 'matches.user', 'matches.user.children', 'matches.user.partners'])
                ->with(['address'])
                ->get()
        );
        return $dinners;
    }

    public function getDinnersByMatchStatus($region, $match_status, $paginate = false, $orderBy = false, $orderDir = 'asc'){

        $dinners = $region->dinners()
                ->where('has_match', $match_status)
                ->where('status_id', '!=', 3)
                ->with(['user', 'user.children', 'user.partners'])
                ->with(['partners'])
                ->with(['children'])
                ->with(['matches', 'matches.user', 'matches.user.children', 'matches.user.partners'])
                ->with(['address']);

        if ($orderBy) {
            $dinners->orderBy($orderBy, $orderDir);
        }

        if ($paginate) {
            return $this->addAdditionalData($dinners->paginate(20));
        }
        else {
            return $this->addAdditionalData($dinners->get());
        }
    }

    public function getDinnersByUser($id) {
        $dinners = $this->addAdditionalData(Dinner::where('user_id', $id)->with('matches')->get());
        return $dinners;
    }

    public function getDinnersByMatchStatusAndUser($match_status, $user_id) {
        $dinners = $this->addAdditionalData(Dinner::where('user_id', $user_id)->where('has_match', $match_status)->with('matches')->get());
        return $dinners;
    }

    public function getMatchedDinnersForUser($id){
        $dinners = Dinner::whereHas('matches', function($query) use($id){
            $query->where('status_id', 2)->where('user_id', $id);
        })->get();
        return $this->addAdditionalData($dinners);
    }

    public function assignAddress($id, $input) {
        if (array_key_exists('address_city', $input)){
            $dinner = $this->find($id);
            $address = $dinner->address;

            if (!$address) {
                $address = new Address();
            }

            $address->street = array_key_exists('address_street', $input) ? $input['address_street'] : '';
            $address->zipcode = array_key_exists('address_zip',$input) ? $input['address_zip'] : '';
            $address->city =  array_key_exists('address_city',$input) ? $input['address_city'] : '';
            $address->country =  array_key_exists('address_country',$input) ? $input['address_country'] : 'SE';

            $dinner->address()->save($address);
        }
    }

    public function assignChildren($id, $input){
        if (array_key_exists('children_age', $input)){
            $dinner = $this->find($id);
            $children_ages = $input['children_age'];
            $dinner->children()->delete();
            foreach ($children_ages as $age){
                $child = new Child(['age' => $age]);
                $dinner->children()->save($child);
            }
        }
    }

    public function assignPartners($id, $input){
        if (array_key_exists('partner_gender', $input)){
            $dinner = $this->find($id);
            $partner_genders = $input['partner_gender'];
            $dinner->partners()->delete();
            foreach ($partner_genders as $gender){
                $partner = new Partner(['gender' => $gender]);
                $dinner->partners()->save($partner);
            }
        }
    }

    private function addAdditionalData($dinners){
        foreach ($dinners as $dinner) {
            $guests = $dinner->guests;
            $host = $dinner->user;
            if ($dinner->has_match) {
                $dinner->title = $host->getFullName() . ': ' . $dinner->matches->first()->user->getFullName();
            }
            else {
                $dinner->title = $dinner->getAddressCityAttribute() . ': ' . $host->getFullName() . ' (' . $host->gender . ')';

                // List children (ages)
                $hasAddedChildLabel = false;
                foreach ($host->children as $child) {
                    if ($child->age > 0) {
                        if ($hasAddedChildLabel == false) {
                            $dinner->title .= " Barn:";
                            $hasAddedChildLabel = true;
                        }
                        $dinner->title = $dinner->title . " " . $child->age;
                    }
                }

                // Add guest preference
                $dinner->title .= ' - ' . config('constants.DINNER_GUEST_CAPACITY')[config('app.locale')][$guests];
            }

            switch ($dinner->getStatus()) {
                case 'has_match':
                    $dinner->color = '#5bc0de'; // BLUE
                    break;
                case 'cancelled':
                    $dinner->color = '#d9534f'; // RED
                    break;
                case 'host_informed':
                    $dinner->color = '#5cb85c'; // GREEN
                    break;
                default:
                    // If host is fluent
                    if (!$host->fluent) {
                        $dinner->color = '#DC9FBC'; // PINK
                    }
                    else {
                        $dinner->color = '#f0ad4e'; // YELLOW
                    }
                    break;
            }
        }
        /*$dinner_sorted = $dinner_sorted->groupBy(
                function ($dinner, $key) {
                    if (strtotime($dinner->date) > time()){
                        return 'future';
                    }
                    return 'past';
                });
        }*/


        return $dinners;
    }
}
