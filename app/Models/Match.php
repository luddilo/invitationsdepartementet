<?php namespace App\Models;

class Match extends BaseModel
{
	public $table = "matches";

	const SUGGESTED = 1;
	const APPROVED = 2;
	const DENIED = 3;

	public $fillable = [
		"status_id",
		"number_of_adults",
		"number_of_children",
		"is_host",
		'match_score',
	];

	protected $casts = [
		"id" => "integer",
		"status_id" => "integer",
		"number_of_adults" => "integer",
		"number_of_children" => "integer",
		"match_score" => "integer"
	];

	public static $rules = [

	];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function dinner() {
		return $this->belongsTo(Dinner::class);
	}

	public function notes() {
		return $this->morphMany(Note::class, 'notable');
	}

	public function getStatus(){
		return $this->status_id;
	}

	public function getStatusAttribute() {
		return config('constants.MATCH_STATUSES')[config('app.locale')][$this->attributes['status_id']];
	}

	public function getStatusCssClass() {
		return config('constants.MATCH_STATUS_CLASSES')[$this->attributes['status_id']];
	}

	public function approve() {
		$this->status_id = self::APPROVED;
		$this->save();
		$this->dinner->setMatchFound(true);
		$this->dinner->removeNonApprovedMatches();
	}

	public function deny() {
		if ($this->status_id == self::APPROVED){
			$this->dinner->setMatchFound(false);
		}
		$this->status_id = self::DENIED;
		$this->save();
	}

	public function reset() {
		//Update dinner
		if ($this->status_id == self::APPROVED){
			$this->dinner->setMatchFound(false);
		}
		//Update (this) match
		if ($this->status_id != self::SUGGESTED) {
			$this->status_id = self::SUGGESTED;
			$this->save();
		}
	}

	public function sentEmail(){
		return $this->sent_email == 1 ? true : false; // In the future we might have other statuses
	}

	public function setEmailSent() {
		$this->sent_email = 1;
		$this->save();
	}

	public function scopeNotApproved($query){
		return $query->where('status_id', '!=', self::APPROVED);
	}
	/*protected function setStatus($status_name) {
		$status = Status::where('name', $status_name)->first();
		$this->status()->associate($status);
		$this->save();
	}*/

	public function resetAndDelete(){
		$this->reset();
		$this->delete();
	}

}
