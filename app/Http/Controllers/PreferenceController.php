<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatePreferenceRequest;
use App\Http\Requests\UpdatePreferenceRequest;
use App\Libraries\Repositories\PreferenceRepository;
use Flash;
use Response;

class PreferenceController extends AppBaseController
{

	/** @var  PreferenceRepository */
	private $preferenceRepository;

	function __construct(PreferenceRepository $preferenceRepo)
	{
		$this->preferenceRepository = $preferenceRepo;
	}

	/**
	 * Display a listing of the Preference.
	 *
	 * @return Response
	 */
	public function index()
	{
		$preferences = $this->preferenceRepository->paginate(10);

		return view('preferences.index')
			->with('preferences', $preferences);
	}

	/**
	 * Show the form for creating a new Preference.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('preferences.create');
	}

	/**
	 * Store a newly created Preference in storage.
	 *
	 * @param CreatePreferenceRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatePreferenceRequest $request)
	{
		$input = $request->all();

		$preference = $this->preferenceRepository->create($input);

		Flash::success('Preference saved successfully.');

		return redirect(route('app.preferences.index'));
	}

	/**
	 * Display the specified Preference.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$preference = $this->preferenceRepository->find($id);

		if(empty($preference))
		{
			Flash::error('Preference not found');

			return redirect(route('app.preferences.index'));
		}

		return view('preferences.show')->with('preference', $preference);
	}

	/**
	 * Show the form for editing the specified Preference.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$preference = $this->preferenceRepository->find($id);

		if(empty($preference))
		{
			Flash::error('Preference not found');

			return redirect(route('app.preferences.index'));
		}

		return view('preferences.edit')->with('preference', $preference);
	}

	/**
	 * Update the specified Preference in storage.
	 *
	 * @param  int              $id
	 * @param UpdatePreferenceRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdatePreferenceRequest $request)
	{
		$preference = $this->preferenceRepository->find($id);

		if(empty($preference))
		{
			Flash::error('Preference not found');

			return redirect(route('app.preferences.index'));
		}

		$preference = $this->preferenceRepository->updateRich($request->all(), $id);

		Flash::success('Preference updated successfully.');

		return redirect(route('app.preferences.index'));
	}

	/**
	 * Remove the specified Preference from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$preference = $this->preferenceRepository->find($id);

		if(empty($preference))
		{
			Flash::error('Preference not found');

			return redirect(route('app.preferences.index'));
		}

		$this->preferenceRepository->delete($id);

		Flash::success('Preference deleted successfully.');

		return redirect(route('app.preferences.index'));
	}
}
