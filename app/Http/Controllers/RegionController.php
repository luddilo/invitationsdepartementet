<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Libraries\Repositories\RegionRepository;
use App\Libraries\Repositories\UserRepository;
use Flash;
use Response;

class RegionController extends AppBaseController
{

	/** @var  RegionRepository */
	private $regionRepository;
	private $userRepository;

	function __construct(RegionRepository $regionRepo, UserRepository $userRepo)
	{
		$this->regionRepository = $regionRepo;
		$this->userRepository = $userRepo;
	}

	/**
	 * Display a listing of the Region.
	 *
	 * @return Response
	 */
	public function index()
	{
		$regions = $this->regionRepository->all();

		return view('regions.index')
			->with('regions', $regions);
	}

	/**
	 * Show the form for creating a new Region.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = $this->userRepository->getByRole('Ambassador')->get()->pluck('full_name', 'id')->all();
		$users = ['' => ''] + $users;
		return view('regions.create')
			->with('users', $users);
	}

	/**
	 * Store a newly created Region in storage.
	 *
	 * @param CreateRegionRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateRegionRequest $request)
	{
		$input = $request->all();

		$region = $this->regionRepository->create($input);

		Flash::success('Region saved successfully.');

		return redirect(route('app.regions.index'));
	}

	/**
	 * Display the specified Region.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$region = $this->regionRepository->find($id);

		if(empty($region))
		{
			Flash::error('Region not found');

			return redirect(route('app.regions.index'));
		}

		return view('regions.show')->with('region', $region);
	}

	/**
	 * Show the form for editing the specified Region.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$region = $this->regionRepository->find($id);
		$users = $this->userRepository->getByRole('Ambassador')->get()->pluck('full_name', 'id')->all();
		$users = ['' => ''] + $users;

		if(empty($region))
		{
			Flash::error('Region not found');

			return redirect(route('app.regions.index'));
		}

		return view('regions.edit')
			->with('region', $region)
			->with('users', $users);
	}

	/**
	 * Update the specified Region in storage.
	 *
	 * @param  int              $id
	 * @param UpdateRegionRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateRegionRequest $request)
	{
		$region = $this->regionRepository->find($id);

		if(empty($region))
		{
			Flash::error('Region not found');

			return redirect(route('app.regions.index'));
		}

		$region = $this->regionRepository->updateRich($request->all(), $id);

		Flash::success('Region updated successfully.');

		return redirect(route('app.regions.index'));
	}

	/**
	 * Remove the specified Region from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$region = $this->regionRepository->find($id);

		if(empty($region))
		{
			Flash::error('Region not found');

			return redirect(route('app.regions.index'));
		}

		$this->regionRepository->delete($id);

		Flash::success('Region deleted successfully.');

		return redirect(route('app.regions.index'));
	}
}
