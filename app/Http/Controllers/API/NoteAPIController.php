<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Libraries\Repositories\NoteRepository;
use App\Models\Note;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class NoteAPIController extends AppBaseController
{
	/** @var  NoteRepository */
	private $noteRepository;

	function __construct(NoteRepository $noteRepo)
	{
		$this->noteRepository = $noteRepo;
	}

	/**
	 * Display a listing of the Note.
	 * GET|HEAD /notes
	 *
	 * @return Response
	 */
	public function index()
	{
		$notes = $this->noteRepository->all();

		return $this->sendResponse($notes->toArray(), "Notes retrieved successfully");
	}

	/**
	 * Show the form for creating a new Note.
	 * GET|HEAD /notes/create
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created Note in storage.
	 * POST /notes
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Note::$rules) > 0)
			$this->validateRequestOrFail($request, Note::$rules);

		$input = $request->all();

		$notes = $this->noteRepository->create($input);

		return $this->sendResponse($notes->toArray(), "Note saved successfully");
	}

	/**
	 * Display the specified Note.
	 * GET|HEAD /notes/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$note = $this->noteRepository->apiFindOrFail($id);

		return $this->sendResponse($note->toArray(), "Note retrieved successfully");
	}

	/**
	 * Show the form for editing the specified Note.
	 * GET|HEAD /notes/{id}/edit
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
	 * Update the specified Note in storage.
	 * PUT/PATCH /notes/{id}
	 *
	 * @param  int              $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$input = $request->all();

		/** @var Note $note */
		$note = $this->noteRepository->apiFindOrFail($id);

		$result = $this->noteRepository->updateRich($input, $id);

		$note = $note->fresh();

		return $this->sendResponse($note->toArray(), "Note updated successfully");
	}

	/**
	 * Remove the specified Note from storage.
	 * DELETE /notes/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->noteRepository->apiDeleteOrFail($id);

		return $this->sendResponse($id, "Note deleted successfully");
	}
}
