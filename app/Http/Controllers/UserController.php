<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Libraries\Repositories\UserRepository;
use App\Models\HQ;
use App\Models\User;
use App\Models\Referrer;
use App\Notifications\UserRegistered;
use Flash;
use Illuminate\Database\QueryException;
use Response;
use App\Models\Role;
use App\Models\Region;
use App\Models\School;
use App\Models\Dinner;
use App\Models\Preference;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\BasicRequest as Request;

class UserController extends AppBaseController
{

	/** @var  UserRepository */
	public $userRepository;

	function __construct(UserRepository $userRepo)
	{
		$this->userRepository = $userRepo;
	}

	/**
	 * Display a listing of the User.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index(Request $request)
	{

		$params = $request->all();

		$data = [
			'dataTableRoute'   => route('api.v1.users.index'),
			'clearSearchRoute' => route('api.v1.users.clearsearch'),
			'saveSearchRoute'  => route('api.v1.users.savesearch'),
		];

		$columns = [
			[
				'data' => 'id',
				'displayName' => 'Id'
			],
			[
				'data' => "first_name",
				'displayName' => trans('general.first_name')
			],
			[
				'data' => 'last_name',
				'displayName' => trans('general.last_name')
			],
			[
				'data' => 'phone',
				'displayName' => trans('general.phone')
			],
			[
				'data' => 'email',
				'displayName' => trans('general.email')
			],
			[
				'data' => 'address.city',
				'displayName' => trans('general.address')
			],
			[
				'data' => 'children',
				'displayName' => trans('general.children')
			],
			[
				'data' => 'partners',
				'displayName' => trans('general.partners')
			],
		];

		$dataColumns = $this->getColumnsForDataTables(array_column($columns, 'data'));
		$filters = [
			'active' => [
				99 => 'Alla',
				1 => 'Aktiva',
				0 => 'Inaktiva'
			],
			'fluent' => [
				99 => 'Alla',
				1 => 'Flytande',
				0 => 'Vill bli bättre'
			],
			'wants_to_guest' => [
				99 => 'Alla',
				1 => 'Vill gå bort',
				0 => 'Vill inte gå bort'
			],
			'wants_to_host' => [
				99 => 'Alla',
				1 => 'Vill bjuda',
				0 => 'Vill inte bjuda'
			],
			'has_guested' => [
				99 => 'Alla',
				1 => 'Har gått bort på middag',
				0 => 'Har inte gått bort på middag'
			],
			'has_hosted' => [
				99 => 'Alla',
				1 => 'Har bjudit på middag',
				0 => 'Har inte bjudit på middag'
			],
			'has_children' => [
				99 => 'Alla',
				1 => 'Har barn',
				0 => 'Har inte barn'
			],
			'has_partners' => [
				99 => 'Alla',
				1 => 'Har partner',
				0 => 'Har inte partners'
			],
			'gender' => [
				99 => 'Alla',
				'F' => 'Kvinna',
				'M' => 'Man',
			],
			/*'has_preferences' => [
				99 => 'Alla',
				1 => 'Har matpreferenser',
				0 => 'Har ej matpreferenser'
			]*/
		];

		if (Auth::user()->hasRole('Administrator')) {
			$admin_filters = [
				'region' => [99 => 'Alla'] + Region::all()->pluck('name', 'name')->toArray(),
				'role' => [99 => 'Alla'] + Role::visible()->pluck('name', 'name')->toArray(),
				'nationality' => [99 => 'Alla'] + User::where('nationality', '<>', '')->orderBy('nationality')->get()->pluck('nationality', 'nationality')->toArray(),
			];
			$filters = array_merge($filters, $admin_filters);
		}

		if (session()->has('search')) {
			$values = session('search');
			$params = array_merge($values, $params);
		}

		return view('users.index', $data)
			->with('columns', $columns)
			->with('dataColumns', $dataColumns)
			->with('filters', $filters)
			->with('params', $params);
	}


	public function getSignup($region_name = null){
		$region = null;
		$messages = [];

		// Try getting region from session
		if (!$region_name && session()->has('region_name')) {
			$region = session('region_name');
			return redirect()->route('signup', ['region' => $region]);
		}

		if ($region_name){
			$region = Region::where('name', $region_name)->firstOrFail();
			session(['region_name' => $region_name]);

			$dateConstraints = $region->date_constraints;

			foreach ($dateConstraints as $dateConstraint) {
				if ($dateConstraint->isActive()){
					if ($dateConstraint->message){
						$messages[] = $dateConstraint->message;
					}
					else {
						$messages[] = config('constants.defaultDateConstraintMessage');
					}
					break;
				}
			}
		}

		$roles = Role::visible()->pluck('name', 'id');
		$preferences_guesting = Preference::all()->pluck('name_guesting', 'id');
		$preferences_hosting = Preference::where('name_hosting', '!=', '')->pluck('name_hosting', 'id');
		$regions = Region::all()->pluck('name', 'id')->all() + [99 => trans('general.no_region_suitable')];

		if ($region) {
			$schools = [''=>''] + $region->schools->pluck('nameAndLevel', 'id')->all();
		}
		else {
			$schools = [''=>''] + School::all()->pluck('nameAndLevel', 'id')->all();
		}

		$referrers = [''=>''] + Referrer::all()->pluck('description', 'id')->all();

		return view('outside.signup')
			->with('roles', $roles)
			->with('region', $region)
			->with('regions', $regions)
			->with('referrers', $referrers)
			->with('schools', $schools)
			->with('preferences_guesting', $preferences_guesting)
			->with('preferences_hosting', $preferences_hosting)
			->with('messages', $messages);
	}

	public function postSignup(CreateUserRequest $request){
		$input = $request->all();

		if (Auth::guest()){ // If we are a guest the form has radio buttons hence wants_to_guest is never set so we set it here.
			$input['wants_to_guest'] = !$input['wants_to_host'];
		}

		// Create user and assign relations
		$user = $this->userRepository->createAndAssign($input);

		// Send slack message
		\Notification::send(new HQ, new UserRegistered($user));

		// Check if user should get dateselection
		if($user->wants_to_host && $user->region->user_dateselection){

			// Check if region has an active dateConstraint, in which case we dont want to show dateselection but send a custom message
			if($user->region->hasActiveDateConstraint()) {

				$this->__sendActiveDateConstraintEmail($user);
				return redirect(route('signup_confirmation', $user->uuid));
			}
			else { // Otherwise we give the user dateselection
				return redirect(route('dateselection', $user->uuid));
			}

		}
		else { // If no dateselection, normal confirmation!
			$this->__sendWelcomeEmail($user);
			return redirect(route('signup_confirmation', $user->uuid));
		}

	}

	public function getConfirmation($uuid){

		$user = User::where('uuid', $uuid)->with('region')->with('region.date_constraints')->first();
		$dateConstraint = $user->region->activeDateConstraint();
		if ($dateConstraint && $dateConstraint->confirmation_signup_message){
			$message = $dateConstraint->confirmation_signup_message;
		}
		else {
			$message = config('constants.defaultConfirmationSignupMessage');
		}

		return view('outside.signup_confirmation')
			->with('message', $message);
	}
	/**
	 * Show the form for creating a new User.
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function create()
	{
		$roles = Role::visible()->pluck('name', 'id');
		$preferences_guesting = Preference::all()->pluck('name_guesting', 'id');
		$preferences_hosting = Preference::where('name_hosting', '!=', '')->pluck('name_hosting', 'id');
		$regions = Region::all()->pluck('name', 'id');
		$schools = [''=>''] + School::all()->pluck('name', 'id')->all();
		$referrers = [''=>''] + Referrer::all()->pluck('description', 'id')->all();

		return view('users.create')
			->with('roles', $roles)
			->with('regions', $regions)
			->with('schools', $schools)
			->with('preferences_guesting', $preferences_guesting)
			->with('preferences_hosting', $preferences_hosting)
			->with('referrers', $referrers);
	}

	/**
	 * Store a newly created User in storage.
	 *
	 * @param CreateUserRequest $request
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function store(CreateUserRequest $request)
	{
		if ($res = $this->validateRequestOrFail($request, User::$rules_signup)) {
			return $res;
		}

		$input = $request->all();

		$user = $this->userRepository->createAndAssign($input);

		Flash::success('User saved successfully.');

		return redirect(route('app.users.index'));
	}

	/**
	 * Display the specified User.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function show($id)
	{
		$user = User::with('address')
			->with('emails.dinner')
			->with('roles')
			->with('school')
			->with('region')
			->with('partners')
			->with('children')
			->with('preferences')
			->with('datepreferences')
			->find($id);

		if(empty($user))
		{
			Flash::error('User not found');

			return redirect(route('app.users.index'));
		}

		return view('users.show')->with('user', $user);
	}


	public function showProfile(){
		return $this->edit(\Auth::user()->id);
	}

	/**
	 * Show the form for editing the specified User.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		if (Session::has('backUrl')) {
			Session::keep('backUrl');
		}

		$user = $this->userRepository->find($id);

		if(empty($user)) {
			Flash::error('User not found');

			return redirect(route('app.users.index'));
		}

		$roles = Role::visible()->pluck('name', 'id');
		$regions = Region::all()->pluck('name', 'id');
		$schools = [''=>''] + School::all()->pluck('name', 'id')->all();
		$preferences_guesting = Preference::all()->pluck('name_guesting', 'id');
		$preferences_hosting = Preference::where('name_hosting', '!=', '')->pluck('name_hosting', 'id');
		$children = $user->children()->pluck('age');
		$partners = $user->partners()->pluck('gender');
		$referrers = [''=>''] + Referrer::all()->pluck('description', 'id')->all();

		return view('users.edit')
			->with('user', $user)
			->with('partners', $partners)
			->with('children', $children)
			->with('roles', $roles)
			->with('regions', $regions)
			->with('schools', $schools)
			->with('preferences_guesting', $preferences_guesting)
			->with('preferences_hosting', $preferences_hosting)
			->with('referrers', $referrers);

	}

	/**
	 * Update the specified User in storage.
	 *
	 * @param  int              $id
	 * @param UpdateUserRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateUserRequest $request)
	{
		// Validate only if input has been sent from edit page
		$rules = User::$rules;
		$rules['email'] = 'required|email|unique:users,email,' . $id;

		if ($request->has('first_name') && $res = $this->validateRequestOrFail($request, $rules)) {
			return $res;
		}

		$user = $this->userRepository->find($id);

		if(empty($user))
		{
			Flash::error('User not found');

			return redirect(route('app.users.index'));
		}

		$input = $request->all();

		$this->userRepository->updateAndReassign($id, $input);

		Flash::success('User updated successfully.');

		return ($url = Session::get('backUrl'))
			? redirect($url)
			: redirect(route('app.users.show', $id));
	}

	/**
	 * Remove the specified User from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->userRepository->find($id);

		if(empty($user))
		{
			Flash::error('User not found');

			return redirect(route('app.users.index'));
		}

		// delete all associated models
		$user->address()->delete();
		$user->datepreferences()->delete();
		$user->notes()->delete();
		$user->authored_notes()->delete();
		$user->children()->delete();
		$user->partners()->delete();
		$user->dinners()->delete();

		foreach ($user->matches as $match){
			// this function also resets the dinner
			$match->resetAndDelete();
		}

		$this->userRepository->delete($id);

		Flash::success('User deleted successfully.');

		return redirect(route('app.users.index'));
	}

	public function getMatchesForDinner($id) {

		Session::flash('backUrl', request()->fullUrl());
		$dinner = Dinner::find($id);
		$user = $this->userRepository->find($dinner->user_id);
		$matches = $this->userRepository->getMatchesForDinner($id);

		return view('matches.index')
			->with('user', $user)
			->with('dinner', $dinner)
			->with('matches', $matches);
	}

	public function getNewMatchesForDinner($id) {

		$this->userRepository->getNewMatchesForDinner($id);

		return back();
	}

	public function getMatchesForUser($id) {

		$user = $this->userRepository->find($id);
		$matches = $this->userRepository->getMatchesForUser($id, $user);

		return view('matches.index_dinners')
			->with('user', $user)
			->with('matches', $matches);
	}

	public function getNewMatchesForUser($id) {

		$user = $this->userRepository->find($id);
		$this->userRepository->getMatchesForUser($id, $user);

		return back();
	}

	public function setRegionForUser($user_id, $region_id) {
		$user = $this->userRepository->find($user_id);
		$this->userRepository->assignRegion($user, ['region_id' => $region_id]);

		return back();
	}

	private function getColumnsForDataTables($column_names){
		$columns = array();

		foreach ($column_names as $column_name) {
			$columns[] = [
				'data' => $column_name,
				'name' => $column_name,
				'defaultContent' => ''
			];
		}

		return $columns;
	}

	public function activate($user_id){
		$user = $this->userRepository->find($user_id);
		$user->activate();
		return back();
	}

	public function inactivate($user_id){
		$user = $this->userRepository->find($user_id);
		$user->inactivate();

		foreach ($user->matches as $match){
			if ($match->status_id == 1) {
				$match->deny();
			}
		}
		return back();
	}

	private function __sendWelcomeEmail($user){
		$email_type = $user->wants_to_host ? 1 : 2;

		$email = new SendWelcomeEmail([
			'email_type' => $email_type,
			'user' => $user,
			'sender' => $user->region->responsible_user
		]);

		$this->dispatch($email);
	}

	private function __sendActiveDateConstraintEmail($user){
		$email = new SendWelcomeEmail([
			'email_type' => 5,
			'user' => $user,
			'sender' => $user->region->responsible_user
		]);
		$this->dispatch($email);
	}

}
