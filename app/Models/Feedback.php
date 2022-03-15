<?php namespace App\Models;


class Feedback extends BaseModel
{
    public $table = "feedback";

    public $fillable = [
        "id",
        "type",
        "date",
        "user_id",
        "feedbackable_id",
        "feedbackable_type",
        "data",
        "created_at",
        "updated_at"
    ];

    protected $casts = [
        "data" => "object",
    ];

    public static $rules = [

    ];

    public function scopeDayAfterDinner($query){
        return $query->where('type', 'DAY_AFTER_DINNER');
    }

    public function scopeFollowups($query){
        return $query->where('type', 'FOLLOWUP');
    }

    public function feedbackable()
    {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}