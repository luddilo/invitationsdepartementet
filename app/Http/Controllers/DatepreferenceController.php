<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateDatepreferenceRequest;
use App\Http\Requests\UpdateDatepreferenceRequest;
use App\Libraries\Repositories\DatepreferenceRepository;
use Flash;
use Response;

class DatepreferenceController extends AppBaseController
{

	/** @var  DatepreferenceRepository */
	private $datepreferenceRepository;

	function __construct(DatepreferenceRepository $datepreferenceRepo)
	{
		$this->datepreferenceRepository = $datepreferenceRepo;
	}

	/**
	 * Display a listing of the Datepreference.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datepreferences = $this->datepreferenceRepository->paginate(10);

		return view('datepreferences.index')
			->with('datepreferences', $datepreferences);
	}

	/**
	 * Show the form for creating a new Datepreference.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('datepreferences.create');
	}

	/**
	 * Store a newly created Datepreference in storage.
	 *
	 * @param CreateDatepreferenceRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateDatepreferenceRequest $request)
	{
		$input = $request->all();

		$datepreference = $this->datepreferenceRepository->create($input);

		Flash::success('Datepreference saved successfully.');

		return redirect(route('datepreferences.index'));
	}

	/**
	 * Display the specified Datepreference.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$datepreference = $this->datepreferenceRepository->find($id);

		if(empty($datepreference))
		{
			Flash::error('Datepreference not found');

			return redirect(route('datepreferences.index'));
		}

		return view('datepreferences.show')->with('datepreference', $datepreference);
	}

	/**
	 * Show the form for editing the specified Datepreference.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$datepreference = $this->datepreferenceRepository->find($id);

		if(empty($datepreference))
		{
			Flash::error('Datepreference not found');

			return redirect(route('datepreferences.index'));
		}

		return view('datepreferences.edit')->with('datepreference', $datepreference);
	}

	/**
	 * Update the specified Datepreference in storage.
	 *
	 * @param  int              $id
	 * @param UpdateDatepreferenceRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateDatepreferenceRequest $request)
	{
		$datepreference = $this->datepreferenceRepository->find($id);

		if(empty($datepreference))
		{
			Flash::error('Datepreference not found');

			return redirect(route('datepreferences.index'));
		}

		$datepreference = $this->datepreferenceRepository->updateRich($request->all(), $id);

		Flash::success('Datepreference updated successfully.');

		return redirect(route('datepreferences.index'));
	}

	/**
	 * Remove the specified Datepreference from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$datepreference = $this->datepreferenceRepository->find($id);

		if(empty($datepreference))
		{
			Flash::error('Datepreference not found');

			return redirect(route('datepreferences.index'));
		}

		$this->datepreferenceRepository->delete($id);

		Flash::success('Datepreference deleted successfully.');

		return redirect(route('datepreferences.index'));
	}
}
