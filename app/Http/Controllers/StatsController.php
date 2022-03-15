<?php namespace App\Http\Controllers;

use App\Libraries\Repositories\StatsRepository;

class StatsController extends Controller {

	public function index(StatsRepository $statsRepository)
	{
		$params = [
			'ages'          => $statsRepository->ages(),
			'children'      => $statsRepository->nrOfChildren(),
			'days'          => $statsRepository->days(),
			'genders'       => $statsRepository->genders(),
			'nationalities' => $statsRepository->nationalities(),
		];

		return view('stats.index', $params);
	}
}