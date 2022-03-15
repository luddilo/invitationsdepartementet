<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Dinner;

class UpdateDinnerRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// Allow if user is an ambassador or administrator or if a participant if it's the owners dinner
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return Dinner::$rules;
	}

}
