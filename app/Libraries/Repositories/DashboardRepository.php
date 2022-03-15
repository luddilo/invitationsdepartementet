<?php namespace App\Libraries\Repositories;

use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;

class DashboardRepository
{

    private function _formatForView($collection){
        $arr = [];
        foreach ($collection as $key => $item){
            $arr[$key] = count($item); // count of dinners
        }
        return $arr;
    }

    private function _getAnonymousFunc($field, $from, $to)
    {
        return function($query) use ($field, $from, $to) {
            if ($from != null) {
                $query->whereDate($field, '>=', $from);
            }

            if ($to != null) {
                $query->whereDate($field, '<=', $to);
            }
        };
    }

    public function getData($user = null, $from = null, $to = null) {

        $data = [];
        $data['months'] = [];

        $dinnersFunc = $this->_getAnonymousFunc('date', $from, $to);
        $userQuery   = User::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);

        // If admin, get data for all regions. If not, only get user's region's data.
        if (!$user || $user->hasRole('Administrator')) {
            $regions = Region::with(['dinners' => $dinnersFunc])->get();
            $usersGr = $userQuery->with('roles')->get()->groupBy('region_id');
        } else {
            $regions = $user->region()->with(['dinners' => $dinnersFunc])->with('users.roles')->get();
            $usersGr = $userQuery->where('region_id', $user->region->id)->get()->groupBy('region_id');
        }

        foreach ($regions as $region) {

            $dataPerRegion = [];

            // Get dinners and group by date (YYYY-MM)
            $dinners = $region->dinners;
            $dataPerRegion['dinnersWithMatches'] = $this->_formatForView($dinners->filter(function ($dinner) {
                return $dinner->has_match;
            })->groupBy(function ($dinner) {
                return Carbon::parse($dinner->date)->format('My');
            }));

            $dataPerRegion['dinnersWithoutMatches'] = $this->_formatForView($dinners->filter(function ($dinner) {
                return !$dinner->has_match;
            })->groupBy(function ($dinner) {
                return Carbon::parse($dinner->date)->format('My');
            }));

            // Get users and group by date (YYYY-MM)
            $users = isset($usersGr[$region->id]) ? $usersGr[$region->id] : collect();

            $dataPerRegion['fluentMembers'] = $this->_formatForView($users->filter(function ($user) {
                return $user->hasRole('Member') && $user->fluent;
            })->groupBy(function ($user) {
                return Carbon::parse($user->created_at)->format('My');
            }));

            $dataPerRegion['nonFluentMembers'] = $this->_formatForView($users->filter(function ($user) {
                return $user->hasRole('Member') && !$user->fluent;
            })->groupBy(function ($user) {
                return Carbon::parse($user->created_at)->format('My');
            }));

            $dataPerRegion['ambassadors'] = $this->_formatForView($users->filter(function ($user) {
                return $user->hasRole('Ambassador');
            })->groupBy(function ($user) {
                return Carbon::parse($user->created_at)->format('My');
            }));

            // Add region data to total array
            $data[str_replace(' ', '_', $region->name)] = $dataPerRegion;

            // Create array of all months (it should be the Union of all months for all regions)
            $data['months'] +=
                array_unique(
                    array_merge(
                        $data['months'],
                        array_keys(
                            array_merge(
                                $dataPerRegion['dinnersWithMatches'],
                                $dataPerRegion['dinnersWithoutMatches'],
                                $dataPerRegion['fluentMembers'],
                                $dataPerRegion['nonFluentMembers']
                            )
                        )
                    )
                );
        }

        // Sort months array
        usort($data['months'], function($a, $b){
            $t1 = Carbon::createFromFormat('My', $a)->timestamp;
            $t2 = Carbon::createFromFormat('My', $b)->timestamp;
            return ($t1 - $t2);
        });

        return $data;
    }

}
