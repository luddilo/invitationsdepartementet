<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\ChildRepository;
use App\Models\Child;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class ChildAPIController extends AppBaseController
{
	/** @var  ChildRepository */
	private $childRepository;

	function __construct(ChildRepository $childRepo)
	{
		$this->childRepository = $childRepo;
	}

	/**
	 * Display a listing of the Child.
	 * GET|HEAD /children
	 *
	 * @return Response
	 */
	public function index()
	{
		$children = $this->childRepository->all();

		return $this->sendResponse($children->toArray(), "Children retrieved successfully");
	}

	/**
	 * Show the form for creating a new Child.
	 * GET|HEAD /children/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Child in storage.
	 * POST /children
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Child::$rules) > 0)
			$this->validateRequestOrFail($request, Child::$rules);

		$input = $request->all();

		$children = $this->childRepository->create($input);

		return $this->sendResponse($children->toArray(), "Child saved successfully");
	}

	/**
	 * Display the specified Child.
	 * GET|HEAD /children/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$child = $this->childRepository->apiFindOrFail($id);

		return $this->sendResponse($child->toArray(), "Child retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Child.
	 * GET|HEAD /children/{id}/edit
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
	 * Update the specified Child in storage.
	 * PUT/PATCH /children/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Child $child */
		$child = $this->childRepository->apiFindOrFail($id);

		$result = $this->childRepository->updateRich($input, $id);

		$child = $child->fresh();

		return $this->sendResponse($child->toArray(), "Child updated successfully");
	}

	/**
	 * Remove the specified Child from storage.
	 * DELETE /children/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->childRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Child deleted successfully");
	}
}
