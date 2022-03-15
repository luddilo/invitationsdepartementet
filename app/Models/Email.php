<?php namespace App\Models;

class Email extends BaseModel
{
	public $table = "emails";

	public $fillable = [
		'token',
		'user_id',
		'dinner_id',
		'sender_id',
		'email_type',
		'region_id',
		'mailgun_id',
		'sent_at',
		'delivered_at',
		'opened_at',
		'delivery_failed_at',
		'delivery_failed_reason',
	];

	protected $dates = [
		'sent_at',
		'delivered_at',
		'opened_at',
		'delivery_failed_at',
	];

	protected static function boot() {
		parent::boot();
		static::addGlobalScope('order', function ($builder) {
			$builder->orderBy('sent_at', 'desc');
		});
	}

	public function dinner()
	{
		return $this->belongsTo(Dinner::class);
	}

	public function region()
	{
		return $this->belongsTo(Region::class);
	}

	public function sender()
	{
		return $this->belongsTo(User::class, 'sender_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
