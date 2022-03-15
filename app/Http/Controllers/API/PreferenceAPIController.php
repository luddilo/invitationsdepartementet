<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\PreferenceRepository;
use App\Models\Preference;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class PreferenceAPIController extends AppBaseController
{
	/** @var  PreferenceRepository */
	private $preferenceRepository;

	function __construct(PreferenceRepository $preferenceRepo)
	{
		$this->preferenceRepository = $preferenceRepo;
	}

	/**
	 * Display a listing of the Preference.
	 * GET|HEAD /preferences
	 *
	 * @return Response
	 */
	public function index()
	{
		$preferences = $this->preferenceRepository->all();

		return $this->sendResponse($preferences->toArray(), "Preferences retrieved successfully");
	}

	/**
	 * Show the form for creating a new Preference.
	 * GET|HEAD /preferences/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Preference in storage.
	 * POST /preferences
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Preference::$rules) > 0)
			$this->validateRequestOrFail($request, Preference::$rules);

		$input = $request->all();

		$preferences = $this->preferenceRepository->create($input);

		return $this->sendResponse($preferences->toArray(), "Preference saved successfully");
	}

	/**
	 * Display the specified Preference.
	 * GET|HEAD /preferences/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$preference = $this->preferenceRepository->apiFindOrFail($id);

		return $this->sendResponse($preference->toArray(), "Preference retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Preference.
	 * GET|HEAD /preferences/{id}/edit
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
	 * Update the specified Preference in storage.
	 * PUT/PATCH /preferences/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Preference $preference */
		$preference = $this->preferenceRepository->apiFindOrFail($id);

		$result = $this->preferenceRepository->updateRich($input, $id);

		$preference = $preference->fresh();

		return $this->sendResponse($preference->toArray(), "Preference updated successfully");
	}

	/**
	 * Remove the specified Preference from storage.
	 * DELETE /preferences/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->preferenceRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Preference deleted successfully");
	}
}
