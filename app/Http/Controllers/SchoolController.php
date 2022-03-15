<?php namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\CreateSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Libraries\Repositories\SchoolRepository;
use Flash;
use Response;

class SchoolController extends AppBaseController
{

	/** @var  SchoolRepository */
	private $schoolRepository;

	function __construct(SchoolRepository $schoolRepo)
	{
		$this->schoolRepository = $schoolRepo;
	}

	/**
	 * Display a listing of the School.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::user()->hasRole('Administrator')){
			$schools = $this->schoolRepository->paginate(10);
		}
		else { //Ambassador
			$schools = $this->schoolRepository->getByRegion(Auth::user()->getRegion())->paginate(10);
		}

		return view('schools.index')
			->with('schools', $schools);
	}

	/**
	 * Show the form for creating a new School.
	 *
	 * @return Response
	 */
	public function create()
	{
		$regions = Region::all()->pluck('name', 'id');
		return view('schools.create')
			->with('regions', $regions);
	}

	/**
	 * Store a newly created School in storage.
	 *
	 * @param CreateSchoolRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateSchoolRequest $request)
	{
		$input = $request->all();

		$school = $this->schoolRepository->create($input);

		Flash::success('School saved successfully.');

		return redirect(route('app.schools.index'));
	}

	/**
	 * Display the specified School.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$school = $this->schoolRepository->find($id);

		if(empty($school))
		{
			Flash::error('School not found');

			return redirect(route('app.schools.index'));
		}

		return view('schools.show')->with('school', $school);
	}

	/**
	 * Show the form for editing the specified School.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$school = $this->schoolRepository->find($id);
		$regions = Region::all()->pluck('name', 'id');

		if(empty($school))
		{
			Flash::error('School not found');

			return redirect(route('app.schools.index'));
		}

		return view('schools.edit')
			->with('school', $school)
			->with('regions', $regions);
	}

	/**
	 * Update the specified School in storage.
	 *
	 * @param  int              $id
	 * @param UpdateSchoolRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateSchoolRequest $request)
	{
		$school = $this->schoolRepository->find($id);

		if(empty($school))
		{
			Flash::error('School not found');

			return redirect(route('app.schools.index'));
		}

		$school = $this->schoolRepository->updateRich($request->all(), $id);

		Flash::success('School updated successfully.');

		return redirect(route('app.schools.index'));
	}

	/**
	 * Remove the specified School from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$school = $this->schoolRepository->find($id);

		if(empty($school))
		{
			Flash::error('School not found');

			return redirect(route('app.schools.index'));
		}

		// Remove parent objects
		$users = $school->users;

		foreach($users as $user){
			$user->school()->delete();
		}

		$this->schoolRepository->delete($id);

		Flash::success('School deleted successfully.');

		return redirect(route('app.schools.index'));
	}
}
