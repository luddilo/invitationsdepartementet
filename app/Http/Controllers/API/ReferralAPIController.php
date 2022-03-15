<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\ReferrerRepository;
use App\Models\Referrer;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class ReferrerAPIController extends AppBaseController
{
	/** @var  ReferrerRepository */
	private $referrerRepository;

	function __construct(ReferrerRepository $referrerRepo)
	{
		$this->referrerRepository = $referrerRepo;
	}

	/**
	 * Display a listing of the Referrer.
	 * GET|HEAD /referrers
	 *
	 * @return Response
	 */
	public function index()
	{
		$referrers = $this->referrerRepository->all();

		return $this->sendResponse($referrers->toArray(), "Referrers retrieved successfully");
	}

	/**
	 * Show the form for creating a new Referrer.
	 * GET|HEAD /referrers/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Referrer in storage.
	 * POST /referrers
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Referrer::$rules) > 0)
			$this->validateRequestOrFail($request, Referrer::$rules);

		$input = $request->all();

		$referrers = $this->referrerRepository->create($input);

		return $this->sendResponse($referrers->toArray(), "Referrer saved successfully");
	}

	/**
	 * Display the specified Referrer.
	 * GET|HEAD /referrers/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$referrer = $this->referrerRepository->apiFindOrFail($id);

		return $this->sendResponse($referrer->toArray(), "Referrer retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Referrer.
	 * GET|HEAD /referrers/{id}/edit
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
	 * Update the specified Referrer in storage.
	 * PUT/PATCH /referrers/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Referrer $referrer */
		$referrer = $this->referrerRepository->apiFindOrFail($id);

		$result = $this->referrerRepository->updateRich($input, $id);

		$referrer = $referrer->fresh();

		return $this->sendResponse($referrer->toArray(), "Referrer updated successfully");
	}

	/**
	 * Remove the specified Referrer from storage.
	 * DELETE /referrers/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->referrerRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Referrer deleted successfully");
	}
}
