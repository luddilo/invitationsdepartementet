<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateReferrerRequest;
use App\Http\Requests\UpdateReferrerRequest;
use App\Libraries\Repositories\ReferrerRepository;
use Flash;
use Response;

class ReferrerController extends AppBaseController
{

	/** @var  ReferrerRepository */
	private $referrerRepository;

	function __construct(ReferrerRepository $referrerRepo)
	{
		$this->referrerRepository = $referrerRepo;
	}

	/**
	 * Display a listing of the Referrer.
	 *
	 * @return Response
	 */
	public function index()
	{
		$referrers = $this->referrerRepository->paginate(10);

		return view('referrers.index')
			->with('referrers', $referrers);
	}

	/**
	 * Show the form for creating a new Referrer.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('referrers.create');
	}

	/**
	 * Store a newly created Referrer in storage.
	 *
	 * @param CreateReferrerRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateReferrerRequest $request)
	{
		$input = $request->all();

		$referrer = $this->referrerRepository->create($input);

		Flash::success('Referrer saved successfully.');

		return redirect(route('app.referrers.index'));
	}

	/**
	 * Display the specified Referrer.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$referrer = $this->referrerRepository->find($id);

		if(empty($referrer))
		{
			Flash::error('Referrer not found');

			return redirect(route('referrers.index'));
		}

		return view('referrers.show')->with('referrer', $referrer);
	}

	/**
	 * Show the form for editing the specified Referrer.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$referrer = $this->referrerRepository->find($id);

		if(empty($referrer))
		{
			Flash::error('Referrer not found');

			return redirect(route('app.referrers.index'));
		}

		return view('referrers.edit')->with('referrer', $referrer);
	}

	/**
	 * Update the specified Referrer in storage.
	 *
	 * @param  int              $id
	 * @param UpdateReferrerRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateReferrerRequest $request)
	{
		$referrer = $this->referrerRepository->find($id);

		if(empty($referrer))
		{
			Flash::error('Referrer not found');

			return redirect(route('app.referrers.index'));
		}

		$referrer = $this->referrerRepository->updateRich($request->all(), $id);

		Flash::success('Referrer updated successfully.');

		return redirect(route('app.referrers.index'));
	}

	/**
	 * Remove the specified Referrer from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$referrer = $this->referrerRepository->find($id);

		if(empty($referrer))
		{
			Flash::error('Referrer not found');

			return redirect(route('app.referrers.index'));
		}

		$this->referrerRepository->delete($id);

		Flash::success('Referrer deleted successfully.');

		return redirect(route('app.referrers.index'));
	}
}
