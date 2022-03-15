<?php namespace App\Models;

class Address extends BaseModel
{
	public $table = "addresses";

	public $fillable = [
		"id",
		"street",
		"zipcode",
		"city",
		"country",
		"coord_x",
		"coord_y",
		"created_at",
		"updated_at"
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		"id" => "integer",
		"street" => "string",
		"zipcode" => "string",
		"city" => "string",
		"country" => "string",
		"coord_x" => "float",
		"coord_y" => "float"
	];

	public static $rules = [

	];

	public function addressable()
	{
		return $this->morphTo();
	}
}
