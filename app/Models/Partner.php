<?php namespace App\Models;

class Partner extends BaseModel
{
	public $table = "partners";

	public $fillable = [
		"id",
		"gender",
		"type",
		"partnerable_id",
		"partnerable_type",
		"created_at",
		"updated_at"
	];

	protected $casts = [
		"id" => "integer",
		"gender" => "string",
		"type" => "string",
		"partnerable_id" => "integer",
		"partnerable_type" => "string"
	];

	public static $rules = [

	];

	public function partnerable()
	{
		return $this->morphTo();
	}

	public function getGender(){
		return config('constants.GENDERS')[config('app.locale')][$this->attributes['gender']];
	}
}
