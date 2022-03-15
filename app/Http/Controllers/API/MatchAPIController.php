<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\MatchRepository;
use App\Models\Match;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class MatchAPIController extends AppBaseController
{
	/** @var  MatchRepository */
	private $matchRepository;

	function __construct(MatchRepository $matchRepo)
	{
		$this->matchRepository = $matchRepo;
	}

	/**
	 * Display a listing of the Match.
	 * GET|HEAD /matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$matches = $this->matchRepository->all();

		return $this->sendResponse($matches->toArray(), "Matches retrieved successfully");
	}

	/**
	 * Show the form for creating a new Match.
	 * GET|HEAD /matches/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Match in storage.
	 * POST /matches
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Match::$rules) > 0)
			$this->validateRequestOrFail($request, Match::$rules);

		$input = $request->all();

		$matches = $this->matchRepository->create($input);

		return $this->sendResponse($matches->toArray(), "Match saved successfully");
	}

	/**
	 * Display the specified Match.
	 * GET|HEAD /matches/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$match = $this->matchRepository->apiFindOrFail($id);

		return $this->sendResponse($match->toArray(), "Match retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Match.
	 * GET|HEAD /matches/{id}/edit
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		// maybe, you can return a template for JS
//		Errors::throwHttpExceptionWithCode(Errors::EDITION_FORM_NOT_EXISTS, ['id' => $id], static::getHATEOAS(['%id' => $id]));
	}

	/**
	 * Update the specified Match in storage.
	 * PUT/PATCH /matches/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Match $match */
		$match = $this->matchRepository->apiFindOrFail($id);

		$result = $this->matchRepository->updateRich($input, $id);

		$match = $match->fresh();

		return $this->sendResponse($match->toArray(), "Match updated successfully");
	}

	/**
	 * Remove the specified Match from storage.
	 * DELETE /matches/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->matchRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Match deleted successfully");
	}
}
