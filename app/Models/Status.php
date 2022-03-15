<?php namespace App\Models;

class Status extends BaseModel
{
	public $table = "statuses";

	public $fillable = [
		"id",
		"name",
		"description",
		"bootstrap_label_class",
	];

	protected $casts = [
		"id" => "integer"
	];

	public static $rules = [

	];

	public function matches() {
		return $this->hasMany(Match::class);
	}

}
