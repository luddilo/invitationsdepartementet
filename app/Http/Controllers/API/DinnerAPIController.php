<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\DinnerRepository;
use App\Models\Dinner;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class DinnerAPIController extends AppBaseController
{
	/** @var  DinnerRepository */
	private $dinnerRepository;

	function __construct(DinnerRepository $dinnerRepo)
	{
		$this->dinnerRepository = $dinnerRepo;
	}

	/**
	 * Display a listing of the Dinner.
	 * GET|HEAD /dinners
	 *
	 * @return Response
	 */
	public function index()
	{
		$dinners = $this->dinnerRepository->all();

		return $this->sendResponse($dinners->toArray(), "Dinners retrieved successfully");
	}

	public function getDinnersForCalendar(Request $request)
	{
		$region = $request->user()->getRegion();
		$from = $request->get('start');
		$to   = $request->get('end');

		$dinners = $this->dinnerRepository->getDinnersForCalendar($region, $from, $to);

		return $dinners;
	}

	/**
	 * Show the form for creating a new Dinner.
	 * GET|HEAD /dinners/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Dinner in storage.
	 * POST /dinners
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Dinner::$rules) > 0)
			$this->validateRequestOrFail($request, Dinner::$rules);

		$input = $request->all();

		$dinners = $this->dinnerRepository->create($input);

		return $this->sendResponse($dinners->toArray(), "Dinner saved successfully");
	}

	/**
	 * Display the specified Dinner.
	 * GET|HEAD /dinners/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$dinner = $this->dinnerRepository->apiFindOrFail($id);

		return $this->sendResponse($dinner->toArray(), "Dinner retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Dinner.
	 * GET|HEAD /dinners/{id}/edit
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
	 * Update the specified Dinner in storage.
	 * PUT/PATCH /dinners/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Dinner $dinner */
		$dinner = $this->dinnerRepository->apiFindOrFail($id);

		$result = $this->dinnerRepository->updateRich($input, $id);

		$dinner = $dinner->fresh();

		return $this->sendResponse($dinner->toArray(), "Dinner updated successfully");
	}

	/**
	 * Remove the specified Dinner from storage.
	 * DELETE /dinners/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->dinnerRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Dinner deleted successfully");
	}

}
