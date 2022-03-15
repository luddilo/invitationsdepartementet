<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends BaseModel
{
    use SoftDeletes;

	public $table = "coupon_codes";

	public $fillable = [
	    'user_id',
        'link',
	];

	public static $rules = [];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
