<?php namespace App\Models;

class Preference extends BaseModel
{
	public $table = "preferences";

	public $fillable = [
		"name_guesting",
		"name_hosting",
		"type"
	];

    protected $casts = [
        "id" => "integer",
    ];

	public static $rules = [
	    
	];

	public function users() {
		return $this->belongsToMany(User::class)->withPivot('guesting');
	}
}
