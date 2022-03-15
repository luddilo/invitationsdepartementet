<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Libraries\Repositories\NoteRepository;
use App\Libraries\Repositories\UserRepository;
use Flash;
use Response;

class NoteController extends AppBaseController
{

	/** @var  NoteRepository */
	private $noteRepository;
	private $userRepository;

	function __construct(NoteRepository $noteRepo, UserRepository $userRepo )
	{
		$this->noteRepository = $noteRepo;
		$this->userRepository = $userRepo;
	}

	/**
	 * Display a listing of the Note.
	 *
	 * @return Response
	 */
	public function index()
	{
		$notes = $this->noteRepository->paginate(10);

		return view('notes.index')
			->with('notes', $notes);
	}

	/**
	 * Show the form for creating a new Note.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('notes.create');
	}

	/**
	 * Store a newly created Note in storage.
	 *
	 * @param CreateNoteRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateNoteRequest $request)
	{

		$input = $request->all();

		$note = $this->noteRepository->create($input);

		Flash::success('Note saved successfully.');

		return back();
	}

	/**
	 * Display the specified Note.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$note = $this->noteRepository->find($id);

		if(empty($note))
		{
			Flash::error('Note not found');

			return redirect(route('notes.index'));
		}

		return view('notes.show')->with('note', $note);
	}

	/**
	 * Show the form for editing the specified Note.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$note = $this->noteRepository->find($id);

		if(empty($note))
		{
			Flash::error('Note not found');

			return redirect(route('notes.index'));
		}

		return view('notes.edit')->with('note', $note);
	}

	/**
	 * Update the specified Note in storage.
	 *
	 * @param  int              $id
	 * @param UpdateNoteRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateNoteRequest $request)
	{
		$note = $this->noteRepository->find($id);

		if(empty($note))
		{
			Flash::error('Note not found');

			return redirect(route('notes.index'));
		}

		$note = $this->noteRepository->updateRich($request->all(), $id);

		Flash::success('Note updated successfully.');

		return redirect(route('notes.index'));
	}

	/**
	 * Remove the specified Note from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$note = $this->noteRepository->find($id);

		if(empty($note))
		{
			Flash::error('Note not found');

			return redirect(route('notes.index'));
		}

		$this->noteRepository->delete($id);

		Flash::success('Note deleted successfully.');

		return back();
	}

	public function getByUser($id) {
		$user = $this->userRepository->find($id);
		$notes = $this->noteRepository->getNotesByUser($id)->sortByDesc('created_at');

		return view('notes.index')
			->with('notes', $notes)
			->with('user', $user);
	}
}
