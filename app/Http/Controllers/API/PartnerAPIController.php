<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\PartnerRepository;
use App\Models\Partner;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class PartnerAPIController extends AppBaseController
{
	/** @var  PartnerRepository */
	private $partnerRepository;

	function __construct(PartnerRepository $partnerRepo)
	{
		$this->partnerRepository = $partnerRepo;
	}

	/**
	 * Display a listing of the Partner.
	 * GET|HEAD /partners
	 *
	 * @return Response
	 */
	public function index()
	{
		$partners = $this->partnerRepository->all();

		return $this->sendResponse($partners->toArray(), "Partners retrieved successfully");
	}

	/**
	 * Show the form for creating a new Partner.
	 * GET|HEAD /partners/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Partner in storage.
	 * POST /partners
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Partner::$rules) > 0)
			$this->validateRequestOrFail($request, Partner::$rules);

		$input = $request->all();

		$partners = $this->partnerRepository->create($input);

		return $this->sendResponse($partners->toArray(), "Partner saved successfully");
	}

	/**
	 * Display the specified Partner.
	 * GET|HEAD /partners/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$partner = $this->partnerRepository->apiFindOrFail($id);

		return $this->sendResponse($partner->toArray(), "Partner retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Partner.
	 * GET|HEAD /partners/{id}/edit
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
	 * Update the specified Partner in storage.
	 * PUT/PATCH /partners/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Partner $partner */
		$partner = $this->partnerRepository->apiFindOrFail($id);

		$result = $this->partnerRepository->updateRich($input, $id);

		$partner = $partner->fresh();

		return $this->sendResponse($partner->toArray(), "Partner updated successfully");
	}

	/**
	 * Remove the specified Partner from storage.
	 * DELETE /partners/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->partnerRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Partner deleted successfully");
	}
}
