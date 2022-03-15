<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\BasicRequest as Request;
use App\Http\Requests\CreateMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Libraries\Repositories\MatchRepository;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Dinner;
use App\Models\User;
use App\Models\Match;
use App\Libraries\EmailSender;

class MatchController extends AppBaseController
{

	/** @var  MatchRepository */
	private $matchRepository;

	function __construct(MatchRepository $matchRepo)
	{
		$this->matchRepository = $matchRepo;
	}

	/**
	 * Display a listing of the Match.
	 *
	 * @return Response
	 */
	public function index()
	{
		$matches = $this->matchRepository->paginate(10);

		return view('matches.index')
			->with('matches', $matches);
	}

	/**
	 * Show the form for creating a new Match.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('matches.create');
	}

	/**
	 * Store a newly created Match in storage.
	 *
	 * @param CreateMatchRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateMatchRequest $request)
	{
		$input = $request->all();

		$match = $this->matchRepository->create($input);

		Flash::success('Match saved successfully.');

		return redirect(route('app.matches.index'));
	}

	/**
	 * Display the specified Match.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$match = $this->matchRepository->find($id);

		if(empty($match))
		{
			Flash::error('Match not found');

			return redirect(route('app.matches.index'));
		}

		return view('matches.show')->with('match', $match);
	}

	/**
	 * Show the form for editing the specified Match.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$match = $this->matchRepository->find($id);

		if(empty($match))
		{
			Flash::error('Match not found');

			return redirect(route('app.matches.index'));
		}

		return view('matches.edit')->with('match', $match);
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int              $id
	 * @param UpdateMatchRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateMatchRequest $request)
	{
		$match = $this->matchRepository->find($id);

		if(empty($match))
		{
			Flash::error('Match not found');

			return redirect(route('app.matches.index'));
		}

		$input = $request->all();
		$match = $this->matchRepository->updateRich($input, $id);
		$this->matchRepository->assignNotes($id, $input);

		Flash::success('Match updated successfully.');

		return back();
	}

	/**
	 * Remove the specified Match from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$match = $this->matchRepository->find($id);

		if(empty($match))
		{
			Flash::error('Match not found');

			return redirect(route('app.matches.index'));
		}

		$match->notes()->delete();
		$this->matchRepository->delete($id);

		Flash::success('Match deleted successfully.');

		return redirect(route('app.matches.index'));
	}

	public function approveMatch($id){
		$match = $this->matchRepository->find($id);
		$match->approve();

		Flash::success('Match godkänd! Nu kan du skicka ett email till värden om du vill');

		return back();
	}

	public function denyMatch($id){
		$match = $this->matchRepository->find($id);
		$match->deny();

		Flash::success('Match nekad! Om du vill kan du matcha personen med en annan middag');

		return back();
	}

	public function createAndApprove($dinner_id, $user_id){

		$dinner = Dinner::find($dinner_id);
		$user = User::find($user_id);

		$match = new Match(
			[
				'match_score' => 0,
			]);
		// Associate match to user
		$match->user()->associate($user);
		// Associate match to dinner
		$dinner->matches()->save($match);
		$match->approve();

		Flash::success('Match godkänd! Nu kan du skicka ett email till värden om du vill');

		return back();
	}


	public function previewEmail($id, $email_type = 3){
		$match = $this->matchRepository->find($id);

		// Data needed to populate the preview email
		$data = [];
		$data['email_type'] = $email_type;
		$data['dinner'] = $match->dinner;
		$data['user'] = $data['dinner']->user;
		$data['guest'] = $match->user;
		$data['sender'] = $data['guest']->region->responsible_user;
		$data['counterpart'] = $match->user->first_name;
		$data['feedback_url'] = env('TYPEFORM_URL_FEEDBACK') . '?fluent=1&host=1&counterpart=' . $data['counterpart'] . '&name=' . $data['user']->first_name . '&uuid=' . $data['user']->uuid;

		if (!$data['sender']){
			$data['sender'] = Auth::user();
		}
		// Get preview
		$preview = EmailSender::sendEmailFromTemplate($email_type, $data, true);

		// Extract content from preview
		$content = $preview['view'];
		$title = $preview['title'];

		return view('emails.preview_and_edit')
			->with('email_type', $email_type)
			->with('match', $match)
			->with('title', $title)
			->with('content', $content)
			->with('to', $data['user']->email);
	}

	public function sendEmail($id, Request $request){

		$match = $this->matchRepository->find($id);

		// Populate content needed to send out email
		$data = [];
		$data['match'] = $match;
		$data['content'] = $request->_content;
		$data['title'] = $request->_title;
		$data['user'] = $match->dinner->user;
		$data['dinner_id'] = $match->dinner->id;
		$data['email_type'] = $request->get('_email_type');
		$data['sender'] = $data['user']->region->responsible_user;
		$data['counterpart'] = $match->user->name;
		$data['feedback_url'] = env('TYPEFORM_URL_FEEDBACK');

		if (!$data['sender']){
			$data['sender'] = Auth::user();
		}

		// Send email
		$result = EmailSender::sendEmailFromContent($data);

		if ($result == true){
			Flash::success('Hurra! Mailet skickades');
			return redirect(route('app.dinners.show', $match->dinner->id));
		}
		else {
			Flash::error('Något gick fel, det gick inte skicka email');
			return back();
		}


	}
}
