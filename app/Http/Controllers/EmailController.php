<?php
namespace App\Http\Controllers;

use App\Models\Email;

class EmailController extends AppBaseController
{
	public function index()
	{
		$emails = Email::with(['region', 'sender', 'user'])->get();
		return view('emails.index', ['emails' => $emails]);
	}
}