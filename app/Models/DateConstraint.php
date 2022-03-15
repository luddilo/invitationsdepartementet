<?php namespace App\Models;
use Carbon\Carbon;


class DateConstraint extends BaseModel
{
	public $table = "date_constraints";

	public $fillable = [
		"constrainable_type",
		"constrainable_id",
		"created_by",
		"from",
		"to",
		"message",
		"confirmation_signup_message"
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		"id" => "integer",
	];

	public static $rules = [
		'from' => 'required',
		'to' => 'required',
	];

	public function constrainable() {
		return $this->morphTo();
	}

	public function isActive($date = null) {

		if ($date){
			$date = Carbon::parse($date);
		}
		else {
			$date = Carbon::today();
		}

		$from = Carbon::parse($this->attributes['from']);
		$to = Carbon::parse($this->attributes['to']);

		if ($this->constrainable_type == 'App\Models\Region'){
			$from->subDays($this->constrainable->minimum_days_notice_dinner);
		}

		return $date >= $from && $date <= $to;
	}

}



