<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\AddressRepository;
use App\Models\Address;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class AddressAPIController extends AppBaseController
{
	/** @var  AddressRepository */
	private $addressRepository;

	function __construct(AddressRepository $addressRepo)
	{
		$this->addressRepository = $addressRepo;
	}

	/**
	 * Display a listing of the Address.
	 * GET|HEAD /addresses
	 *
	 * @return Response
	 */
	public function index()
	{
		$addresses = $this->addressRepository->all();

		return $this->sendResponse($addresses->toArray(), "Addresses retrieved successfully");
	}

	/**
	 * Show the form for creating a new Address.
	 * GET|HEAD /addresses/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Address in storage.
	 * POST /addresses
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Address::$rules) > 0)
			$this->validateRequestOrFail($request, Address::$rules);

		$input = $request->all();

		$addresses = $this->addressRepository->create($input);

		return $this->sendResponse($addresses->toArray(), "Address saved successfully");
	}

	/**
	 * Display the specified Address.
	 * GET|HEAD /addresses/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$address = $this->addressRepository->apiFindOrFail($id);

		return $this->sendResponse($address->toArray(), "Address retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Address.
	 * GET|HEAD /addresses/{id}/edit
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
	 * Update the specified Address in storage.
	 * PUT/PATCH /addresses/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Address $address */
		$address = $this->addressRepository->apiFindOrFail($id);

		$result = $this->addressRepository->updateRich($input, $id);

		$address = $address->fresh();

		return $this->sendResponse($address->toArray(), "Address updated successfully");
	}

	/**
	 * Remove the specified Address from storage.
	 * DELETE /addresses/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->addressRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Address deleted successfully");
	}

	public function getAddressByUser($id) {
		$address = $this->addressRepository->getAddressByUser($id);

		return $this->sendResponse($address->toArray(), "Address retrieved successfully");
	}
}
