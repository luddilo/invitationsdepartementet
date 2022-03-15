<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\DatepreferenceRepository;
use App\Models\Datepreference;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class DatepreferenceAPIController extends AppBaseController
{
	/** @var  DatepreferenceRepository */
	private $datepreferenceRepository;

	function __construct(DatepreferenceRepository $datepreferenceRepo)
	{
		$this->datepreferenceRepository = $datepreferenceRepo;
	}

	/**
	 * Display a listing of the Datepreference.
	 * GET|HEAD /datepreferences
	 *
	 * @return Response
	 */
	public function index()
	{
		$datepreferences = $this->datepreferenceRepository->all();

		return $this->sendResponse($datepreferences->toArray(), "Datepreferences retrieved successfully");
	}

	/**
	 * Show the form for creating a new Datepreference.
	 * GET|HEAD /datepreferences/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Datepreference in storage.
	 * POST /datepreferences
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Datepreference::$rules) > 0)
			$this->validateRequestOrFail($request, Datepreference::$rules);

		$input = $request->all();

		$datepreferences = $this->datepreferenceRepository->create($input);

		return $this->sendResponse($datepreferences->toArray(), "Datepreference saved successfully");
	}

	/**
	 * Display the specified Datepreference.
	 * GET|HEAD /datepreferences/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$datepreference = $this->datepreferenceRepository->apiFindOrFail($id);

		return $this->sendResponse($datepreference->toArray(), "Datepreference retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Datepreference.
	 * GET|HEAD /datepreferences/{id}/edit
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
	 * Update the specified Datepreference in storage.
	 * PUT/PATCH /datepreferences/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Datepreference $datepreference */
		$datepreference = $this->datepreferenceRepository->apiFindOrFail($id);

		$result = $this->datepreferenceRepository->updateRich($input, $id);

		$datepreference = $datepreference->fresh();

		return $this->sendResponse($datepreference->toArray(), "Datepreference updated successfully");
	}

	/**
	 * Remove the specified Datepreference from storage.
	 * DELETE /datepreferences/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->datepreferenceRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Datepreference deleted successfully");
	}
}
