<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\RoleRepository;
use App\Models\Role;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class RoleAPIController extends AppBaseController
{
	/** @var  RoleRepository */
	private $roleRepository;

	function __construct(RoleRepository $roleRepo)
	{
		$this->roleRepository = $roleRepo;
	}

	/**
	 * Display a listing of the Role.
	 * GET|HEAD /roles
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = $this->roleRepository->all();

		return $this->sendResponse($roles->toArray(), "Roles retrieved successfully");
	}

	/**
	 * Show the form for creating a new Role.
	 * GET|HEAD /roles/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Role in storage.
	 * POST /roles
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Role::$rules) > 0)
			$this->validateRequestOrFail($request, Role::$rules);

		$input = $request->all();

		$roles = $this->roleRepository->create($input);

		return $this->sendResponse($roles->toArray(), "Role saved successfully");
	}

	/**
	 * Display the specified Role.
	 * GET|HEAD /roles/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$role = $this->roleRepository->apiFindOrFail($id);

		return $this->sendResponse($role->toArray(), "Role retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Role.
	 * GET|HEAD /roles/{id}/edit
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
	 * Update the specified Role in storage.
	 * PUT/PATCH /roles/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Role $role */
		$role = $this->roleRepository->apiFindOrFail($id);

		$result = $this->roleRepository->updateRich($input, $id);

		$role = $role->fresh();

		return $this->sendResponse($role->toArray(), "Role updated successfully");
	}

	/**
	 * Remove the specified Role from storage.
	 * DELETE /roles/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->roleRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Role deleted successfully");
	}
}
