<?php namespace App\Models;

class Datepreference extends BaseModel
{
	public $table = "datepreferences";

	public $fillable = [
	    "id",
		"user_id",
		"day_id",
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
		"user_id" => "integer",
		"day_id" => "integer"
    ];

	public static $rules = [
	    
	];

	public function user() {
		return $this->belongsTo(User::class);
	}
}
