<?php namespace App\Models;


class Note extends BaseModel
{
	public $table = "notes";

	public $fillable = [
	    "id",
		"content",
		"notable_id",
		"notable_type",
		"author_id",
		"created_at",
		"updated_at"
	];

    protected $casts = [
        "id" => "integer",
		"content" => "string",
		"notable_id" => "integer",
		"notable_type" => "string",
		"author_id" => "integer"
    ];

	public static $rules = [
	    
	];

	public function notable()
	{
		return $this->morphTo();
	}

	public function author() {
		return $this->belongsTo(User::class);
	}

}
