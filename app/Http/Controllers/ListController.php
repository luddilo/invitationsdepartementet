<?php namespace App\Http\Controllers;

use App\Models\Dinner;
use App\Models\User;

class ListController extends Controller
{

	public function bookingTime()
	{
		$dinners = Dinner::selectRaw('COUNT(id) AS `count`, TIMESTAMPDIFF(DAY, `created_at`, `date`) AS day_diff')->groupBy('day_diff')->pluck('count', 'day_diff');

		return view('lists.booking_time')->with('data', $dinners)->with('total', Dinner::count());
	}

	/**
	 * @todo Temporary, used to show list for users that signed up during christmas break
	 */
	public function christmas()
	{
		$start = '2016-12-01 00:00:00';
		$end   = '2017-01-31 23:59:59';

		$users = User::active()->notGuested()->notHosted()->where('created_at', '>=', $start)->where('created_at', '<=', $end)->orderBy('created_at')->get();
		return view('lists.users')->with('data', $users);
	}

	public function notBookedYet()
	{
		$users = User::active()->notGuested()->notHosted()->orderBy('created_at')->get();
		return view('lists.users')->with('data', $users);
	}

	public function users()
	{
		$users = User::all();
		return view('lists.users')->with('data', $users);
	}

}
