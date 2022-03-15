<?php namespace App\Libraries\Repositories;

use App\Models\Child;
use App\Models\Dinner;
use App\Models\User;

class StatsRepository extends BaseRepository
{
	public function model()
	{
		return User::class;
	}

	protected function _userCountListQuery($field)
	{
		return User::select([$field])->selectRaw('COUNT(id) AS `count`')->groupBy($field);
	}

	protected function _userCountList($field)
	{
		return $this->_userCountListQuery($field)->pluck('count', $field);
	}

	public function ages()
	{
		$_ages = $this->_userCountList('age');
		$ages = [];

		foreach ($_ages as $k => $v) {
			$key = config('constants.AGE.sv.' . $k);
			$ages[$key] = $v;
		}

		return $ages;
	}

	public function days()
	{
		return Dinner::selectRaw('COUNT(id) AS `count`, DATE_FORMAT(`date`, \'%W\') AS `day`')->groupBy('day')->pluck('count', 'day');
	}

	public function genders()
	{
		return $this->_userCountList('gender');
	}

	public function nationalities()
	{
		return $this->_userCountListQuery('nationality')->having('count', '>', 30)->pluck('count', 'nationality');
	}

	public function nrOfChildren()
	{
		$users = User::all();
		$children = Child::select(['childable_id'])->selectRaw('COUNT(id) AS `count`')->where('childable_type', 'App\Models\Dinner')->whereIn('childable_id', $users->pluck('id'))->groupBy('childable_id')->get();

		$groups = $children->groupBy('count');
		$_return = [];

		foreach ($groups as $k => $group) {
			$_return[$k] = count($group);
		}

		$_return[0] = $users->count() - array_sum($_return);
		return $_return;
	}
}