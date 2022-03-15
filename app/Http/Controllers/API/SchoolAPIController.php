<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\SchoolRepository;
use App\Models\School;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class SchoolAPIController extends AppBaseController
{
	/** @var  SchoolRepository */
	private $schoolRepository;

	function __construct(SchoolRepository $schoolRepo)
	{
		$this->schoolRepository = $schoolRepo;
	}

	/**
	 * Display a listing of the School.
	 * GET|HEAD /schools
	 *
	 * @return Response
	 */
	public function index()
	{
		$schools = $this->schoolRepository->all();

		return $this->sendResponse($schools->toArray(), "Schools retrieved successfully");
	}

	/**
	 * Show the form for creating a new School.
	 * GET|HEAD /schools/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created School in storage.
	 * POST /schools
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(School::$rules) > 0)
			$this->validateRequestOrFail($request, School::$rules);

		$input = $request->all();

		$schools = $this->schoolRepository->create($input);

		return $this->sendResponse($schools->toArray(), "School saved successfully");
	}

	/**
	 * Display the specified School.
	 * GET|HEAD /schools/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$school = $this->schoolRepository->apiFindOrFail($id);

		return $this->sendResponse($school->toArray(), "School retrieved successfully");
	}

	/**
	 * Show the form for editing the specified School.
	 * GET|HEAD /schools/{id}/edit
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
	 * Update the specified School in storage.
	 * PUT/PATCH /schools/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var School $school */
		$school = $this->schoolRepository->apiFindOrFail($id);

		$result = $this->schoolRepository->updateRich($input, $id);

		$school = $school->fresh();

		return $this->sendResponse($school->toArray(), "School updated successfully");
	}

	/**
	 * Remove the specified School from storage.
	 * DELETE /schools/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->schoolRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "School deleted successfully");
	}
}
