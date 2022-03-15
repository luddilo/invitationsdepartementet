<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\RegionRepository;
use App\Models\Region;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class RegionAPIController extends AppBaseController
{
	/** @var  RegionRepository */
	private $regionRepository;

	function __construct(RegionRepository $regionRepo)
	{
		$this->regionRepository = $regionRepo;
	}

	/**
	 * Display a listing of the Region.
	 * GET|HEAD /regions
	 *
	 * @return Response
	 */
	public function index()
	{
		$regions = $this->regionRepository->all();

		return $this->sendResponse($regions->toArray(), "Regions retrieved successfully");
	}

	/**
	 * Show the form for creating a new Region.
	 * GET|HEAD /regions/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Region in storage.
	 * POST /regions
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Region::$rules) > 0)
			$this->validateRequestOrFail($request, Region::$rules);

		$input = $request->all();

		$regions = $this->regionRepository->create($input);

		return $this->sendResponse($regions->toArray(), "Region saved successfully");
	}

	/**
	 * Display the specified Region.
	 * GET|HEAD /regions/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$region = $this->regionRepository->apiFindOrFail($id);

		return $this->sendResponse($region->toArray(), "Region retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Region.
	 * GET|HEAD /regions/{id}/edit
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
	 * Update the specified Region in storage.
	 * PUT/PATCH /regions/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Region $region */
		$region = $this->regionRepository->apiFindOrFail($id);

		$result = $this->regionRepository->updateRich($input, $id);

		$region = $region->fresh();

		return $this->sendResponse($region->toArray(), "Region updated successfully");
	}

	/**
	 * Remove the specified Region from storage.
	 * DELETE /regions/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->regionRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Region deleted successfully");
	}
}
