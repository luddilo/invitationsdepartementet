<?php namespace App\Models;

class School extends BaseModel
{
	public $table = "schools";

	public $fillable = [
		"id",
		"name",
		"level",
		"region_id"
	];

	protected $casts = [
		"id" => "integer",
		"name" => "string",
		"level" => "string",
		"region_id" => "integer"
	];

	public static $rules = [

	];

	public function getNameAndLevelAttribute() {
		return $this->attributes['name'] . ': ' . $this->attributes['level'];
	}

	public function region(){
		return $this->belongsTo(Region::class);
	}

	public function users(){
		return $this->hasMany(User::class);
	}

}
