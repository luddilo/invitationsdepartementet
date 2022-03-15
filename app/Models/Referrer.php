<?php namespace App\Models;

class Referrer extends BaseModel
{
	public $table = "referrers";

	public $fillable = [
	    "id",
		"name",
		"description",
		"created_at",
		"updated_at"
	];

    protected $casts = [
        "id" => "integer",
		"name" => "string",
		"description" => "string",
    ];

	public static $rules = [
	    
	];

	public function users() {
		return $this->hasMany(User::class);
	}

}
