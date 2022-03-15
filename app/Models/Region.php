<?php namespace App\Models;

class Region extends BaseModel
{
	public $table = "regions";

	public $fillable = [
		"id",
		"name",
		"capacity_dinners_per_week",
		"minimum_days_notice_dinner",
		"inactive_until",
		"inactive_from",
		"address_id",
		"responsible_user_id",
		"email",
		"user_dateselection"
	];

	protected $casts = [
		"id" => "integer",
		"name" => "string",
		"capacity_dinners_per_week" => "integer",
		"minimum_days_notice_dinner" => "integer",
		"address_id" => "integer",
		"responsible_user_id" => "integer",
		"user_dateselection" => "boolean"
	];

	public static $rules = [

	];

	public function users() {
		return $this->hasMany(User::class);
	}

	public function responsible_user() {
		return $this->belongsTo(User::class);
	}

	public function schools() {
		return $this->hasMany(School::class);
	}

	public function dinners() {
		return $this->hasManyThrough(Dinner::class, User::class);
	}

	public function address() {
		return $this->morphOne(Address::class, 'addressable');
	}

	public function date_constraints() {
		return $this->morphMany(DateConstraint::class, 'constrainable');
	}

	public function emailTemplates(){
		return $this->hasMany(EmailTemplate::class);
	}

	public function getWelcomeEmailTemplateSuffix(){
		$regionName = $this->attributes['name'];
		if ($regionName == 'Stockholm'){
			return 'stockholm';
		}
		else if ($regionName == 'Luleå'){
			return 'lulea';
		}
		else {
			return 'other';
		}
	}

	public function getConfirmationEmailTemplateSuffix() {
		if ($this->attributes['name'] == 'Stockholm'){
			return 'other';
		}
		else {
			return 'other';
		}
	}

	public function hasActiveDateConstraint() {
		foreach ($this->date_constraints as $dateConstraint) {
			if ($dateConstraint->isActive()){
				return true;
			}
		}
		return false;
	}

	public function activeDateConstraint() {
		foreach ($this->date_constraints as $dateConstraint) {
			if ($dateConstraint->isActive()){
				return $dateConstraint;
			}
		}
		return null;
	}
}
