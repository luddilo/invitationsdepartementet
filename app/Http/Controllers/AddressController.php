<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Libraries\Repositories\AddressRepository;
use Flash;
use Response;

class AddressController extends AppBaseController
{

	/** @var  AddressRepository */
	private $addressRepository;

	function __construct(AddressRepository $addressRepo)
	{
		$this->addressRepository = $addressRepo;
	}

	/**
	 * Display a listing of the Address.
	 *
	 * @return Response
	 */
	public function index()
	{
		$addresses = $this->addressRepository->paginate(10);

		return view('addresses.index')
			->with('addresses', $addresses);
	}

	/**
	 * Show the form for creating a new Address.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('addresses.create');
	}

	/**
	 * Store a newly created Address in storage.
	 *
	 * @param CreateAddressRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateAddressRequest $request)
	{
		$input = $request->all();

		$address = $this->addressRepository->create($input);

		Flash::success('Address saved successfully.');

		return redirect(route('app.addresses.index'));
	}

	/**
	 * Display the specified Address.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$address = $this->addressRepository->find($id);

		if(empty($address))
		{
			Flash::error('Address not found');

			return redirect(route('app.addresses.index'));
		}

		return view('addresses.show')->with('address', $address);
	}

	/**
	 * Show the form for editing the specified Address.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$address = $this->addressRepository->find($id);

		if(empty($address))
		{
			Flash::error('Address not found');

			return redirect(route('app.addresses.index'));
		}

		return view('addresses.edit')->with('address', $address);
	}

	/**
	 * Update the specified Address in storage.
	 *
	 * @param  int              $id
	 * @param UpdateAddressRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateAddressRequest $request)
	{
		$address = $this->addressRepository->find($id);

		if(empty($address))
		{
			Flash::error('Address not found');

			return redirect(route('app.addresses.index'));
		}

		$address = $this->addressRepository->updateRich($request->all(), $id);

		Flash::success('Address updated successfully.');

		return redirect(route('app.addresses.index'));
	}

	/**
	 * Remove the specified Address from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$address = $this->addressRepository->find($id);

		if(empty($address))
		{
			Flash::error('Address not found');

			return redirect(route('app.addresses.index'));
		}

		$this->addressRepository->delete($id);

		Flash::success('Address deleted successfully.');

		return redirect(route('app.addresses.index'));
	}
}
