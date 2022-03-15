<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateDateConstraintRequest;
use App\Http\Requests\UpdateDateConstraintRequest;
use App\Libraries\Repositories\DateConstraintRepository;
use App\Models\Match;
use Flash;
use Response;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class DateConstraintController extends AppBaseController
{

	/** @var  DateConstraintRepository */
	private $dateConstraintRepository;

	function __construct(DateConstraintRepository $dateConstraintRepo)
	{
		$this->dateConstraintRepository = $dateConstraintRepo;
	}

	/**
	 * Display a listing of the DateConstraint.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$date_constraints = $user->region->date_constraints;

		return view('date_constraints.index')
			->with('date_constraints', $date_constraints);
	}

	/**
	 * Show the form for creating a new DateConstraint.
	 *
	 * @return Response
	 */
	public function create()
	{
		$regions = Auth::user()->myRegions()->pluck('name', 'id');

		return view('date_constraints.create')
			->with('regions', $regions);
	}

	/**
	 * Store a newly created DateConstraint in storage.
	 *
	 * @param CreateDateConstraintRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateDateConstraintRequest $request)
	{
		$input = $request->all();
		$date_constraint = $this->dateConstraintRepository->create($input);

		Flash::success('DateConstraint saved successfully.');

		if ($date_constraint->constrainable_type == 'App\Models\User')
		{
			if (isset($input['match_id'])) {
				$match_id = $input['match_id'];
				Match::find($match_id)->deny();
			}

			return back();
		}
		else {
			return redirect(route('app.date_constraints.index'));
		}
	}

	/**
	 * Display the specified DateConstraint.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$date_constraint = $this->dateConstraintRepository->find($id);

		if(empty($date_constraint))
		{
			Flash::error('DateConstraint not found');

			return redirect(route('date_constraints.index'));
		}

		return view('date_constraints.show')->with('date_constraint', $date_constraint);
	}

	/**
	 * Show the form for editing the specified DateConstraint.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{

		$date_constraint = $this->dateConstraintRepository->find($id);
		$regions = Auth::user()->myRegions()->pluck('name', 'id');

		if(empty($date_constraint))
		{
			Flash::error('DateConstraint not found');

			return redirect(route('date_constraints.index'));
		}

		return view('date_constraints.edit')
			->with('date_constraint', $date_constraint)
			->with('regions', $regions);
	}

	/**
	 * Update the specified DateConstraint in storage.
	 *
	 * @param  int              $id
	 * @param UpdateDateConstraintRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateDateConstraintRequest $request)
	{
		$date_constraint = $this->dateConstraintRepository->find($id);

		if(empty($date_constraint))
		{
			Flash::error('DateConstraint not found');

			return redirect(route('app.date_constraints.index'));
		}

		$date_constraint = $this->dateConstraintRepository->updateRich($request->all(), $id);

		Flash::success('DateConstraint updated successfully.');

		return redirect(route('app.date_constraints.index'));
	}

	/**
	 * Remove the specified DateConstraint from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$date_constraint = $this->dateConstraintRepository->find($id);

		if(empty($date_constraint))
		{
			Flash::error('DateConstraint not found');

			return redirect(route('app.date_constraints.index'));
		}

		if ($date_constraint->constrainable_type == 'App\Models\User')
		{
			$this->dateConstraintRepository->delete($id);

			return back();
		}
		else {
			$this->dateConstraintRepository->delete($id);

			Flash::success('DateConstraint deleted successfully.');

			return redirect(route('app.date_constraints.index'));
		}
	}
}
