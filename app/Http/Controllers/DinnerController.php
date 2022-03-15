<?php namespace App\Http\Controllers;

use App\Models\Dinner;
use App\Models\HQ;
use App\Notifications\UserSelectedDate;
use App\Notifications\UserWillSelectDateLater;
use Carbon\Carbon;
use App\Http\Requests\CreateDinnerRequest;
use App\Http\Requests\UpdateDinnerRequest;
use App\Libraries\Repositories\DinnerRepository;
use App\Libraries\Repositories\UserRepository;
use Flash;
use Response;
use App\Models\User;
use App\Jobs\SendWelcomeEmail;
use App\Http\Requests\BasicRequest;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendAdminEmailNotificationForNewDinner;
use Illuminate\Support\Facades\Auth;

class DinnerController extends AppBaseController
{

	/** @var  DinnerRepository */
	private $dinnerRepository;
	private $userRepository;

	function __construct(DinnerRepository $dinnerRepo, UserRepository $userRepo)
	{
		$this->dinnerRepository = $dinnerRepo;
		$this->userRepository = $userRepo;
	}

	public function dateSelection(BasicRequest $request, $uuid, $another = false){

		// User
		$user = User::where('uuid', $uuid)->first();
		if (!$user) {
			return redirect()->route('apply_for_another_dinner');
		}

		// Set vars
		$region = $user->region;
		$dateConstraints = $region->date_constraints;
		$messages = [];

		// Check date constraints for region and get message for view
		foreach ($dateConstraints as $dateConstraint) {
			if ($dateConstraint->isActive()){
				if ($dateConstraint->message){
					$messages[] = $dateConstraint->message;
				}
				else {
					$messages[] = config('constants.defaultDateConstraintMessage');
				}
			}
		}

		$noticeTime = [
			'from' => '2014-01-01',
			'to' => Carbon::now()->addDays($region->minimum_days_notice_dinner)->format('Y-m-d')
		];

		$dateConstraints = array_merge($dateConstraints->toArray(), [$noticeTime]);
		$startDate = $noticeTime['to'];

		return view('outside.dateselection')
			->with('uuid', $user->uuid)
			->with('dateConstraints', $dateConstraints)
			->with('startDate', $startDate)
			->with('another', $another)
			->with('messages', $messages)
			->with('selectedDate', $request->get('selected'));
	}

	public function dateSelectionAnother(BasicRequest $request){
		return view('outside.dateselection_another_getemail');

	}

	public function selectDateLater($uuid){
		$user = User::where('uuid', $uuid)->firstOrFail();

		if (!$user) {
			return redirect()->route('apply_for_another_dinner');
		}

		// Update user
		$user->update(['pending_date_selection' => true]);

		// Slack
		\Notification::send(new HQ, new UserWillSelectDateLater($user));

		return view('outside.dateselection_later_confirmation');
	}

	public function postDateSelection(CreateDinnerRequest $request){

		$input = $request->all();
		$user = User::where('uuid', $input['uuid'])->first();
		$not_first_dinner = $input['another'];

		// Update date selection pending
		$user->update(['pending_date_selection' => false]);

		if (count($user->dinners) > 0 && $not_first_dinner != true){
			Flash::error(trans('general.dateselection_error') . $user->region->email);
			return redirect()->back();
		}

		$data = [
			'date' => $input['date'],
			'user_id' => $user->id,
			'guests' => $user->guests,
			'address_city' => $user->address->city,
			'other_info' => $user->other_info,
			'partner_gender' => $user->partners->pluck('gender')->toArray(),
			'children_age' => $user->children->pluck('age')->toArray()
		];

		$dinner = $this->dinnerRepository->create($data);
		$this->dinnerRepository->assignAddress($dinner->id, $data);
		$this->dinnerRepository->assignChildren($dinner->id, $data);
		$this->dinnerRepository->assignPartners($dinner->id, $data);

		\Notification::send(new HQ, new UserSelectedDate($user, $dinner));

		$email = new SendWelcomeEmail([
			'email_type' => 6,
			'user' => $user,
			'sender' => $user->region->responsible_user,
			'dinner' => $dinner
		]);

		$this->dispatch($email);

		return view('outside.dateselection_confirmation');
	}

	public function postDateSelectionAnotherEmail(BasicRequest $request){

		$input = $request->all();
		$user = User::where('email', $input['email'])->first();

		if (!$user){
			return redirect()->back()->withErrors(['Är du säker på att detta är den mailadress du registrerat dig med?']);
		}
		else if ($user->hasPendingDinners()){
			return view('outside.dateselection_already_pending_dinner')
				->with('contact_email', $user->region->email);
		}

		if (!$user->wants_to_host){ // Since the email template needs to know that the user is hosting. This function is only for hosting members.
			$user->wants_to_host = true;
			$user->save();
		}

		if ($user->region->user_dateselection){
			return $this->dateSelection($request, $user->uuid, $another = true);
		}
		else {

			$email_to_admin = new SendAdminEmailNotificationForNewDinner([
				'user' => $user,
				'recipient_email' => $user->region->email
			]);

			$email_to_user = new SendWelcomeEmail([
				'email_type' => 1,
				'user' => $user,
				'sender' => $user->region->responsible_user,
			]);

			$this->dispatch($email_to_admin);
			$this->dispatch($email_to_user);

			return view('outside.signup_confirmation');
		}
	}

	/**
	 * Display a listing of matched Dinners.
	 *
	 * @return Response
	 */

	public function getMatched() {
		return $this->index($match_status = true);
	}

	/**
	 * Display a listing of unmatched Dinners.
	 *
	 * @return Response
	 */

	public function getUnMatched() {
		return $this->index($match_status = false);
	}

	/**
	 * Display a listing of Dinners.
	 *
	 * @return Response
	 */
	public function index($match_status = false)
	{
		$region = Auth::user()->getRegion();

		$orderBy = request('column', false);
		$orderDir = request('order', 'asc');

		// Check that sortable column is allowed, default to column: date
		if (!in_array($orderBy, Dinner::$sortable)) {
			$orderBy = 'date';
		}

		$dinners = $this->dinnerRepository->getDinnersByMatchStatus($region, $match_status, $paginate = true, $orderBy, $orderDir);
		$header = $match_status ? trans('general.matched') : trans('general.unmatched');
		$newSortOrder = request('order') == 'asc' ? 'desc' : 'asc';

		return view('dinners.index')
			->with('header', $header)
			->with('dinners', $dinners)
			->with('newSortOrder', $newSortOrder);
	}

	public function getCalendar() {
		return view('dinners.calendar')
			->with('eventsRoute', route('api.v1.dinners.calendar'));
	}

	/**
	 * Show the form for creating a new Dinner.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = ['' => trans('general.existing_user')] + $this->userRepository->getByRegion()->get()->sortBy('first_name')->pluck('full_name', 'id')->all();
		return view('dinners.create_landing')
			->with('users', $users);
	}

	/**
	 * Store a newly created Dinner in storage.
	 *
	 * @param CreateDinnerRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateDinnerRequest $request)
	{
		$input = $request->all();
		$dinner = $this->dinnerRepository->create($input);
		$this->dinnerRepository->assignAddress($dinner->id, $input);
		$this->dinnerRepository->assignChildren($dinner->id, $input);
		$this->dinnerRepository->assignPartners($dinner->id, $input);

		Flash::success('Dinner saved successfully.');

		return redirect(route('app.dinners.show', $dinner->id));
	}

	/**
	 * Display the specified Dinner.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		Session::flash('backUrl', request()->fullUrl());
		$dinner = $this->dinnerRepository->find($id);

		if(empty($dinner))
		{
			Flash::error('Dinner not found');

			return redirect(route('app.dinners.index'));
		}

		$canPreviewFeedback = false;

		if ($dinner->hasAcceptedMatch()){
			$matches = collect([$dinner->acceptedMatch()]);

			$regionUsesCalendar = $dinner->user->region->user_dateselection;

			// Manual send only if no calendar
			$canPreviewFeedback = !$regionUsesCalendar && !$dinner->feedback_status_host;
		}
		else {
			$matches = $dinner->matches()->where('status_id', '!=', '3')->get();
			// Remove inactive users
			// Cant be done in query above because of date constraints
			$matches = $matches->filter(function($match) use ($dinner) {
				return $match->user->isActive($dinner->date);
			});
		}
		$matchFluency = !$dinner->user->fluent; // Matches should be opposite fluency

		$guests = ['' => trans('general.choose_person_manually')] +
			$this->userRepository->getByRoleFluencyRegion('Member', $matchFluency)->where('wants_to_guest', true)->get()->pluck('full_name', 'id')->all();

		$dinner->load('emails');

		return view('dinners.show')
			->with('canPreviewFeedback', $canPreviewFeedback)
			->with('dinner', $dinner)
			->with('matches', $matches)
			->with('users', $guests);
	}

	/**
	 * Show the form for editing the specified Dinner.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$dinner = $this->dinnerRepository->find($id);
		$children = $dinner->children()->pluck('age');
		$partners = $dinner->partners()->pluck('gender');
		$users = $this->userRepository->getByRegion()->get()->pluck('full_name', 'id');

		if(empty($dinner))
		{
			Flash::error('Dinner not found');

			return redirect(route('app.dinners.index'));
		}

		return view('dinners.edit')
			->with('dinner', $dinner)
			->with('children', $children)
			->with('partners', $partners)
			->with('user', $dinner->user)
			->with('users', $users);
	}

	/**
	 * Update the specified Dinner in storage.
	 *
	 * @param  int              $id
	 * @param UpdateDinnerRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateDinnerRequest $request)
	{
		$dinner = $this->dinnerRepository->find($id);

		if(empty($dinner))
		{
			Flash::error('Dinner not found');

			return redirect(route('app.dinners.index'));
		}

		$input = $request->all();

		$dinner = $this->dinnerRepository->updateRich($input, $id);
		$this->dinnerRepository->assignAddress($id, $input);
		$this->dinnerRepository->assignChildren($id, $input);
		$this->dinnerRepository->assignPartners($id, $input);

		Flash::success('Dinner updated successfully.');

		return redirect(route('app.dinners.show', $id));
	}

	/**
	 * Remove the specified Dinner from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$dinner = $this->dinnerRepository->find($id);

		if(empty($dinner))
		{
			Flash::error('Dinner not found');

			return redirect(route('app.dinners.index'));
		}

		$dinner->partners()->delete();
		$dinner->children()->delete();
		$dinner->matches()->delete();
		$dinner->address()->delete();
		$dinner->notes()->delete();

		$this->dinnerRepository->delete($id);

		Flash::success('Dinner deleted successfully.');

		return redirect(route('app.dinners.index'));
	}

	public function activate($id)
	{
		$dinner = $this->dinnerRepository->find($id);

		if(empty($dinner))
		{
			Flash::error('Dinner not found');

			return redirect(route('app.dinners.index'));
		}

		$this->dinnerRepository->activate($id);

		Flash::success('Dinner activated.');

		return back();
	}

	public function cancel($id)
	{
		$dinner = $this->dinnerRepository->find($id);

		if(empty($dinner))
		{
			Flash::error('Dinner not found');

			return redirect(route('app.dinners.index'));
		}

		$this->dinnerRepository->cancel($id);

		Flash::success('Dinner cancelled.');

		return back();
	}

	public function getDinnersByUser($id) {

		$user = User::findOrFail($id);
		$guesting_dinners = $this->dinnerRepository->getMatchedDinnersForUser($id);
		$dinners_with_matches = $this->dinnerRepository->getDinnersByMatchStatusAndUser(true, $id);
		$dinners_without_matches = $this->dinnerRepository->getDinnersByMatchStatusAndUser(false, $id);

		return view('dinners.index_for_user')
			->with('user', $user)
			->with('hosting_dinners_with_matches', $dinners_with_matches)
			->with('hosting_dinners_without_matches', $dinners_without_matches)
			->with('guesting_dinners', $guesting_dinners);
	}

	public function newDinnerByUser($id) {
		$user = User::findOrFail($id);
		$users = $this->userRepository->getByRegion()->get()->pluck('full_name', 'id');
		$children = $user->children()->pluck('age');
		$partners = $user->partners()->pluck('gender');
		$address = $user->address;
		$defaultDate = \Carbon::now()->format('Y-m-d');

		return view('dinners.create')
			->with('user', $user)
			->with('users', $users)
			->with('children', $children)
			->with('partners', $partners)
			->with('address', $address)
			->with('default_date', $defaultDate);
	}

}
