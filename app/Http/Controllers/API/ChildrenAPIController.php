<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\ChildrenRepository;
use App\Models\Children;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class ChildrenAPIController extends AppBaseController
{
	/** @var  ChildrenRepository */
	private $childrenRepository;

	function __construct(ChildrenRepository $childrenRepo)
	{
		$this->childrenRepository = $childrenRepo;
	}

	/**
	 * Display a listing of the Children.
	 * GET|HEAD /childrens
	 *
	 * @return Response
	 */
	public function index()
	{
		$childrens = $this->childrenRepository->all();

		return $this->sendResponse($childrens->toArray(), "Childrens retrieved successfully");
	}

	/**
	 * Show the form for creating a new Children.
	 * GET|HEAD /childrens/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Children in storage.
	 * POST /childrens
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Children::$rules) > 0)
			$this->validateRequestOrFail($request, Children::$rules);

		$input = $request->all();

		$childrens = $this->childrenRepository->create($input);

		return $this->sendResponse($childrens->toArray(), "Children saved successfully");
	}

	/**
	 * Display the specified Children.
	 * GET|HEAD /childrens/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$children = $this->childrenRepository->apiFindOrFail($id);

		return $this->sendResponse($children->toArray(), "Children retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Children.
	 * GET|HEAD /childrens/{id}/edit
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
	 * Update the specified Children in storage.
	 * PUT/PATCH /childrens/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Children $children */
		$children = $this->childrenRepository->apiFindOrFail($id);

		$result = $this->childrenRepository->updateRich($input, $id);

		$children = $children->fresh();

		return $this->sendResponse($children->toArray(), "Children updated successfully");
	}

	/**
	 * Remove the specified Children from storage.
	 * DELETE /childrens/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->childrenRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Children deleted successfully");
	}
}
