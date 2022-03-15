<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController as AppBaseController;

class UserAPIController extends AppBaseController
{
	/** @var  UserRepository */
	private $userRepository;

	function __construct(UserRepository $userRepo)
	{
		$this->userRepository = $userRepo;
	}

	/**
	 * Display a listing of the User.
	 * GET|HEAD /users
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$params = $request->all();
		$query = User::query();

		$user = Auth::user();

		if(!$user->hasRole('Administrator')){
			$query->region($user->region->name);
			$query->members();
		}
		else {
			if (array_key_exists('region', $params)) {
				$query->region($params['region']);
			}
			if (array_key_exists('role', $params)) {
				if ($params['role'] == 'Member')
					$query->members();
				else if ($params['role'] == 'Ambassador')
					$query->ambassadors();
				else if ($params['role'] == 'Administrator')
					$query->administrators();
			}

			if (array_key_exists('nationality', $params) && $params['nationality'] != 99) {
				$query->nationality($params['nationality']);
			 }
		}

		if (array_key_exists('fluent', $params)) {
			if ($params['fluent'] == 1)
				$query->fluent();
			else
				$query->nonFluent();
		}

		if (array_key_exists('active', $params)) {
			if ($params['active'] == 1)
				$query->active();
			else
				$query->inactive();
		}

		if (array_key_exists('wants_to_guest', $params)) {
			if ($params['wants_to_guest'] == 1)
				$query->wantsToGuest();
			else
				$query->doesntWantToGuest();
		}

		if (array_key_exists('wants_to_host', $params)) {
			if ($params['wants_to_host'] == 1)
				$query->wantsToHost();
			else
				$query->doesntWantToHost();
		}

		if (array_key_exists('has_guested', $params)) {
			if ($params['has_guested'] == 1)
				$query->Guested();
			else
				$query->notGuested();
		}

		if (array_key_exists('has_hosted', $params)) {
			if ($params['has_hosted'] == 1)
				$query->hosted();
			else
				$query->notHosted();
		}

		if (array_key_exists('has_children', $params)) {
			if ($params['has_children'] == 1)
				$query->hasChildren();
			else
				$query->hasNoChildren();
		}

		if (array_key_exists('has_partners', $params)) {
			if ($params['has_partners'] == 1)
				$query->hasPartners();
			else
				$query->hasNoPartners();
		}

		if (array_key_exists('has_preferences', $params)) {
			if ($params['has_preferences'] == 1)
				$query->hasPreferences();
			else if ($params['has_preferences'] == 0)
				$query->hasNoPreferences();
			else
				$query->hasPreference($params['has_preferences']);
		}

		if (array_key_exists('gender', $params)) {
			if (in_array($params['gender'], ['M', 'F'])) {
				$query->where('gender', $params['gender']);
			}
		}

		$users = $query
			->with(['address' => function($query){
				$query->select('addressable_id', 'city');
			}])
			->leftJoin(
				\DB::raw('
					(SELECT GROUP_CONCAT(`children`.`age` SEPARATOR ", ") AS `children`, childable_id FROM `children`
					WHERE `childable_type` = \'App\\\Models\\\User\'
					GROUP BY(childable_id)
					) AS `children`
				'), 'children.childable_id', '=', 'users.id'
			)
			->leftJoin(
				\DB::raw('
					(SELECT GROUP_CONCAT(`partners`.`gender` SEPARATOR ", ") AS `partners`, partnerable_id FROM `partners`
					WHERE `partnerable_type` = \'App\\\Models\\\User\'
					GROUP BY(partnerable_id)
					) AS `partners`
				'), 'partners.partnerable_id', '=', 'users.id'
			)
			->select('users.id', 'first_name', 'last_name', 'email', 'phone', 'children', 'partners')
			->get();

		return response($users);
	}

	public function getAmbassadors() {
		$region = Auth::user()->getRegion();
		$users = $this->userRepository->getByRoleAndRegion('Ambassador', $region->name)->with('region')->get();
		return response($users);
	}

	public function clearSearch(Request $request)
	{
		$request->session()->forget(['search']);
		return;
	}

	public function saveSearch(Request $request)
	{
		session(['search' => $request->all()]);
		return;
	}

	/**
	 * Show the form for creating a new User.
	 * GET|HEAD /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created User in storage.
	 * POST /users
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(User::$rules) > 0)
			$this->validateRequestOrFail($request, User::$rules);

		$input = $request->all();

		$users = $this->userRepository->create($input);

		return $this->sendResponse($users->toArray(), "User saved successfully");
	}

	/**
	 * Display the specified User.
	 * GET|HEAD /users/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->userRepository->apiFindOrFail($id);

		return $this->sendResponse($user->toArray(), "User retrieved successfully");
	}

	/**
	 * Show the form for editing the specified User.
	 * GET|HEAD /users/{id}/edit
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
	 * Update the specified User in storage.
	 * PUT/PATCH /users/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var User $user */
		$user = $this->userRepository->apiFindOrFail($id);

		$result = $this->userRepository->updateRich($input, $id);

		$user = $user->fresh();

		return $this->sendResponse($user->toArray(), "User updated successfully");
	}

	/**
	 * Remove the specified User from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->userRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "User deleted successfully");
	}
}
