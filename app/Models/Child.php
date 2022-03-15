<?php namespace App\Models;

class Child extends BaseModel
{
	public $table = "children";

	public $fillable = [
		"age",
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		"id" => "integer",
		"age" => "integer",
		"childable_id" => "integer",
		"childable_type" => "string"
	];

	public static $rules = [

	];

	public function childable()
	{
		return $this->morphTo();
	}

}
