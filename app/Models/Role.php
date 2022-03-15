<?php namespace App\Models;

class Role extends BaseModel
{
	public $table = "roles";

	public $fillable = [
		"name",
		"visible"
	];

	protected $casts = [
		"id" => "integer",
		"name" => "string",
		"visible" => "boolean",
	];

	public static $rules = [

	];

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public function users() {
		return $this->belongsToMany(User::class);
	}

	public function matchingRole() {
		if ($this->name == 'New'){
			return 'Established';
		}
		return 'New';
	}

}
