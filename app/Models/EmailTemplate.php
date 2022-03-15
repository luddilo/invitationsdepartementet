<?php

namespace App\Models;

class EmailTemplate extends BaseModel
{
	public $table = "email_templates";

	public $fillable = [
		"title",
		"paragraph1",
		"paragraph2",
		"paragraph3",
		"signature",
		"email_type",
		"region_id",
		"created_by"
	];

	public static $rules = [
	];

	public function getEmailType() {
		return config('constants.emailTypes')[$this->attributes['email_type']];
	}

	public function region(){
		return $this->belongsTo(Region::class);
	}
}
