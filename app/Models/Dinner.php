<?php namespace App\Models;

use Carbon\Carbon;

class Dinner extends BaseModel
{
	public $table = "dinners";

	const ACTIVE = 1;
	const HAS_MATCH = 2;
	const CANCELLED = 3;
	const HOST_INFORMED_ABOUT_MATCH = 4;

	public $fillable = [
		"date",
		"quantity_established",
		"quantity_new",
		"user_id",
		"guests",
		"other_info",
		"created_by",
		"feedback_status_host",
		"feedback_status_guest",
		"followup_status"
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		"id" => "integer",
		"quantity_established" => "integer",
		"quantity_new" => "integer",
		"user_id" => "integer",
		"adress_id" => "integer",
		"has_host" => "string"
	];

	public static $rules = [
		'date' => 'required',
	];

	public static $sortable = [
		'created_at', 'date'
	];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function partners() {
		return $this->morphMany(Partner::class, 'partnerable');
	}

	public function children() {
		return $this->morphMany(Child::class, 'childable');
	}

	public function matches() {
		return $this->hasMany(Match::class);
	}

	public function address() {
		return $this->morphOne(Address::class, 'addressable');
	}

	public function emails()
	{
		return $this->hasMany(Email::class)->orderBy('sent_at', 'desc');
	}

	public function notes() {
		return $this->morphMany(Note::class, 'notable');
	}

	public function feedbacked() {
		return $this->morphMany(Feedback::class, 'feedbackable');
	}

	public function acceptedMatch(){
		return $this->matches()->where('status_id', self::HAS_MATCH)->first();
	}

	public function acceptedGuest(){
		return $this->acceptedMatch()->user;
	}

	public function getAddressStreetAttribute() {
		if ($this->address) {
			return $this->address->street;
		}
		return null;
	}

	public function getAddressZipAttribute() {
		if ($this->address) {
			return $this->address->zipcode;
		}
		return null;
	}

	public function getAddressCityAttribute() {
		if ($this->address) {
			return $this->address->city;
		}
		return null;
	}

	public function getStatusName(){
		return config('constants.DINNER_STATUSES')[config('app.locale')][$this->attributes['status_id']];
	}

	public function getPrettyDate(){
		$date = Carbon::parse($this->attributes['date']);
		return
			config('constants.WEEKDAYS')[config('app.locale')][$date->dayOfWeek] . ' den ' .
			$date->day . ' ' .
			config('constants.MONTH')[config('app.locale')][$date->month];
	}

	public function getStatus(){
		if ($this->status_id == self::ACTIVE) {
			return 'active';
		}
		elseif ($this->status_id == self::HAS_MATCH) {
			return 'has_match';
		}
		elseif ($this->status_id == self::CANCELLED) {
			return 'cancelled';
		}
		elseif ($this->status_id == self::HOST_INFORMED_ABOUT_MATCH) {
			return 'host_informed';
		}
		return 'none';
	}

	public function setStatus($status_name){
		if ($status_name == 'has_match'){
			$this->status_id = self::HAS_MATCH;
		}
		else if ($status_name == 'active'){
			$this->status_id = self::ACTIVE;
		}
		else if ($status_name == 'cancelled'){
			$this->status_id = self::CANCELLED;
		}
		else if ($status_name == 'host_informed'){
			$this->status_id = self::HOST_INFORMED_ABOUT_MATCH;
		}

		$this->save();
	}

	public function setMatchFound($matchFound){
		if ($matchFound) {
			$this->has_match = 1;
			$this->setStatus('has_match');
		}
		else {
			$this->has_match = 0;
			$this->setStatus('active');
		}
		$this->save();
	}

	public function setHostInformed(){
		$this->setStatus('host_informed');
	}

	public function setFeedbackEmailSent($guest_or_host = 'guest'){
		$guest_or_host == 'guest' ? $this->feedback_status_guest = 1 : $this->feedback_status_host = 1;
		$this->save();
	}

	public function setFollowupEmailSent($guest_or_host = 'guest'){
		$guest_or_host == 'guest' ? $this->followup_status_guest = 1 : $this->followup_status_host = 1;
		$this->save();
	}

	public function setFeedbackReceived($user_id){
		if ($this->user_id == $user_id) { // if the feedback received is our host
			$this->feedback_status_host = 2;
		}
		else { // the feedback received was our guest
			$this->feedback_status_guest = 2;
		}
		$this->save();
	}

	public function removeNonApprovedMatches(){
		$this->matches()->where('status_id', '!=', Match::APPROVED)->delete();
	}

	public function hasInformedHost(){
		return $this->status_id == self::HOST_INFORMED_ABOUT_MATCH;
	}

	public function hasAcceptedMatch(){
		return !is_null($this->acceptedMatch());
	}

	// Query scopes

	public function scopeActive($query){
		$now = Carbon::now()->toDateString();
		return $query->where('date', '>', $now);
	}

	public function scopeWithoutMatches($query){
		return $query->where('has_match', 0);
	}

	public function scopeMatched($query){
		return $query->where('has_match', 1);
	}

	public function scopeWithoutFeedback($query){
		return $query->where(function($query){
			$query->where('feedback_status_host', 0)
				->orWhere('feedback_status_guest', 0);

		});
	}

	public function scopeWithoutFollowup($query){
		return $query->where(function($query){
			$query->where('followup_status_host', 0)
				->orWhere('followup_status_guest', 0);

		});
	}
}
