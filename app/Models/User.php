<?php namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel implements
	AuthenticatableContract,
	AuthorizableContract,
	CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, Notifiable;

	public $table = "users";

	public $fillable = [
		"id",
		"first_name",
		"last_name",
		"email",
		"password",
		"remember_token",
		"phone",
		"age",
		"wants_to_host",
		"wants_to_guest",
		"partners",
		'region_id',
		'gender',
		'fluent',
		'nationality',
		"other_info",
		"created_by",
		"referrer_id",
		"referrer_name",
		"uuid",
		"guests",
		"pending_date_selection"
	];

	protected $hidden = ['password', 'remember_token'];
	protected $casts = [
		"id" => "integer",
		//"email" => "string",
		"password" => "string",
		"remember_token" => "string",
		"phone" => "string",
		"age" => "integer",
		"partners" => "string",
		"address_id" => "integer",
		"region_id" => "integer",
	];

	public static $rules = [
		'first_name' => 'required',
		'email' => 'required|email',
	];

	public static $rules_signup = [
		'first_name' => 'required',
		'email' => 'required|email|unique:users',
	];

	// RELATIONS
	public function emails()
	{
		return $this->hasMany(Email::class);
	}

	public function roles() {
		return $this->belongsToMany(Role::class);
	}

	public function region() {
		return $this->belongsTo(Region::class);
	}

	public function referrer() {
		return $this->belongsTo(Referrer::class);
	}

	public function school() {
		return $this->belongsTo(School::class);
	}

	public function address() {
		return $this->morphOne(Address::class, 'addressable');
	}

	public function children() {
		return $this->morphMany(Child::class, 'childable');
	}

	public function date_constraints() {
		return $this->morphMany(DateConstraint::class, 'constrainable');
	}

	public function partners() {
		return $this->morphMany(Partner::class, 'partnerable');
	}

	public function preferences() {
		return $this->belongsToMany(Preference::class)->withPivot('guesting');
	}

	public function datepreferences() {
		return $this->hasMany(Datepreference::class);
	}

	public function dinners() {
		return $this->hasMany(Dinner::class);
	}

	public function matches() {
		return $this->hasMany(Match::class);
	}

	public function notes() {
		return $this->morphMany(Note::class, 'notable');
	}

	public function feedback() {
		return $this->hasMany(Feedback::class);
	}

	public function feedbacked() {
		return $this->morphMany(Feedback::class, 'feedbackable');
	}

	public function authored_notes() {
		return $this->hasMany(Note::class, 'author_id');
	}

	// Scopes

	public function scopeRegion($query, $region_name){
		return $query->whereHas('region', function($query) use($region_name){
			$query->where('name', $region_name);
		});
	}

	public function scopeActive($query){
		return $query
				->where('active', 1)
				// for some reason orDoesntHave doenst work here so we pass in an "or" parameter instead
				->doesntHave('date_constraints', 'and', function($query){
					$date = Carbon::today()->format('Y-m-d');
					$query->where('from', '<=', $date)
						->where('to', '>=', $date);
				});
	}

	public function scopeInactive($query){
		return $query
				->where('active', 0)
				// .. or temporary inactive
				->orwhereHas('date_constraints', function($query){
					$date = Carbon::today()->format('Y-m-d');
					$query->where('from', '<=', $date)
						->where('to', '>=', $date);
				});
	}

	public function scopeFluent($query){
		return $query->where('fluent', 1);
	}

	public function scopeNonFluent($query){
		return $query->where('fluent', 0);
	}

	public function scopeRole($query, $role_name){
		return $query->whereHas('roles', function($query) use($role_name){
			$query->where('name', $role_name);
		});
	}

	public function scopeMembers($query){
		return $this->scopeRole($query, 'Member');
	}

	public function scopeAmbassadors($query){
		return $this->scopeRole($query, 'Ambassador');
	}

	public function scopeAdministrators($query){
		return $this->scopeRole($query, 'Administrator');
	}

	public function scopeWantsToGuest($query){
		return $query->where('wants_to_guest', 1);
	}

	public function scopeDoesntWantToGuest($query){
		return $query->where('wants_to_guest', 0);
	}

	public function scopeWantsToHost($query){
		return $query->where('wants_to_host', 1);
	}

	public function scopeDoesntWantToHost($query){
		return $query->where('wants_to_host', 0);
	}

	public function scopeGuested($query){
		return $query->whereHas('matches', function($query) {
			$query->where('status_id', 2);
		});
	}

	public function scopeNotGuested($query){
		return $query->whereDoesntHave('matches', function($query) {
			$query->where('status_id', 2);
		});
	}

	public function scopeHosted($query){
		return $query->whereHas('dinners', function($query) {
			$query->where('has_match', 1);
		});
	}

	public function scopeNotHosted($query){
		return $query->whereDoesntHave('dinners', function($query) {
			$query->where('has_match', 1);
		});
	}

	public function scopeHasChildren($query){
		return $query->has('children');
	}

	public function scopeHasNoChildren($query){
		return $query->doesntHave('children');
	}

	public function scopeHasPartners($query){
		return $query->has('partners');
	}

	public function scopeHasNoPartners($query){
		return $query->doesntHave('partners');
	}

	public function scopeHasPreference($query, $preference_name){
		return $query->whereHas('preferences', function($query) use($preference_name){
			$query->where('name_guesting', $preference_name)
				->orWhere('name_hosting', $preference_name);
		});
	}

	public function scopeHasPreferences($query){
		return $query->has('preferences');
	}

	public function scopeHasNoPreferences($query){
		return $query->doesntHave('preferences');
	}

	public function scopeNationality($query, $nationality)
	{
		return $query->where('nationality', $nationality);
	}


	// Getters


	public function hostedDinners(){
		return $this->dinners->filter(function($dinner){
			return $dinner->has_match;
		});
	}

	public function guestedDinners(){
		return $this->matches->filter(function($match){
			return $match->getStatus() == 2;
		});
	}

	public function pendingHostingDinners(){
		return $this->dinners->filter(function($dinner){
			$now = strtotime(date("Y-m-d", time()));
			return strtotime($dinner->date) >= $now && $dinner->status_id != 3;
		});
	}

	public function pendingGuestingDinners(){
		return $this->matches->filter(function($match){
			$now = strtotime(date("Y-m-d", time()));
			// Check if match is approved and dinner is in the future
			return $match->getStatus() == 2 && strtotime($match->dinner->date) >= $now && $match->dinner->status_id != 3;
		});
	}

	public function hasPendingDinners(){
		return count($this->pendingHostingDinners()) + count($this->pendingGuestingDinners()) > 0;
	}

	public function hasHostedDinner(){
		return count($this->hostedDinners()) > 0;
	}

	public function hasGuestedDinner(){
		return count($this->guestedDinners()) > 0;
	}


	public function getFullName() {
		return $this->getFullNameAttribute();
	}

	public function getFullNameAttribute() {
		return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
	}

	public function getPhoneAttribute()
	{
		return preg_replace('#.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{2})(\d{2}).*#', '$1 $2 $3 $4', $this->attributes['phone']);
	}

	public function getPreferenceListGuestingAttribute() {
		$preferences = $this->preferences()->get()->filter(function($preference){
			return $preference->pivot->guesting == true;
		});
		return $preferences->pluck('id')->toArray();
	}

	public function getPreferenceListHostingAttribute() {
		$preferences = $this->preferences()->get()->filter(function($preference){
			return $preference->pivot->guesting == false;
		});
		return $preferences->pluck('id')->toArray();
	}

	public function getGuestingPreferences(){
		$preferences = $this->preferences()->get()->filter(function($preference){
			return $preference->pivot->guesting == true;
		});
		return $preferences;
	}

	public function getHostingPreferences(){
		$preferences = $this->preferences()->get()->filter(function($preference){
			return $preference->pivot->guesting == false;
		});
		return $preferences;
	}

	public function getDatepreferenceListAttribute() {
		return $this->datepreferences->pluck('day_id')->toArray();
	}

	public function getRoleListAttribute() {
		return $this->roles->pluck('id')->toArray();
	}

	public function getAddressStreetAttribute() {
		if ($this->address) {
			return $this->address->street . ' ';
		}
		return null;
	}

	public function getAddressZipAttribute() {
		if ($this->address) {
			return $this->address->zipcode . ' ';
		}
		return null;
	}

	public function getAddressCityAttribute() {
		if ($this->address) {
			return $this->address->city;
		}
		return null;
	}

	public function getLangProficiencyAttribute(){
		return config('constants.LANGUAGE_PROFICIENCIES')[config('app.locale')][$this->attributes['fluent']];
	}

	public function getAddressAttributes() {
		$street = $this->getAddressStreetAttribute();
		$zip = $this->getAddressZipAttribute();
		$city = $this->getAddressCityAttribute();
		return $street . $zip . $city;
	}

	public function getRegion() {
		return $this->region;
	}

	public function myRegions() {
		if ($this->HasRole('Administrator')){
			return Region::all();
		}
		return collect([$this->region]);
	}

	// ROLES

	/*
	 * Returns collection of the user's regions (or all if admin)
	 */

	private function getUserRole()
	{
		return $this->roles()->get();
	}


	public function hasRole($role_string) {
		return !!$this->roles->where('name', $role_string)->first();
	}

	public function hasRoles($roles)
	{
		$myRoles = $this->getUserRole();
		if (count($myRoles) == 0){
			return false;
		}
		// Check if the user is a root account
		if($this->hasRole('Root')) {
			return true;
		}
		if(is_array($roles)){
			foreach($roles as $role){
				if($this->hasRole($role)) {
					return true;
				}
			}
		} else {
			return $this->hasRole($roles);
		}
		return false;
	}

	public function getGender(){
		return config('constants.GENDERS')[config('app.locale')][$this->attributes['gender']];
	}

	public function getAge(){
		return config('constants.AGE')[config('app.locale')][$this->attributes['age']];
	}

	public function getStatus(){

		if ($this->hasPendingDinners()){
			return 'has_pending_dinner';
		}
		else if ($this->hasHostedDinner()){
			return 'has_hosted_dinner';
		}
		else if ($this->hasGuestedDinner()){
			return 'has_guested_dinner';
		}
		else {
			return 'has_not_been_to_dinner';
		}
	}

	/**
	 * Returns rich status.
	 *
	 * @return string
	 */
	public function getStatusName(){

		if ($this->hasPendingDinners()){
			return trans('general.has_pending_dinner');
		}
		else if ($this->hasHostedDinner() && $this->hasGuestedDinner()){
			return trans('general.has_guested_and_hosted_dinner',
				[
					'latest_date' => date('d-M', strtotime($this->dinners->sortByDesc('date')->first()->date)),
					'quantity_hosting' => count($this->hostedDinners()),
					'quantity_guesting' => count($this->guestedDinners())
				]);
		}
		else if ($this->hasHostedDinner()){
			return trans('general.has_hosted_dinner',
				[
					'latest_date' => date('d-M', strtotime($this->dinners->sortByDesc('date')->first()->date)),
					'quantity' => count($this->hostedDinners())
				]);
		}
		else if ($this->hasGuestedDinner()){
			return trans('general.has_guested_dinner',
				[
					'latest_date' => date('d-M', strtotime($this->guestedDinners()->sortByDesc('id')->first()->dinner->date)),
					'quantity' => count($this->guestedDinners())
				]);
		}
		else {
			return trans('general.has_not_been_to_dinner');
		}
	}

	public function isActive($date = null) {
		return $this->active && !$this->hasActiveDateConstraint($date);
	}

	public function activate() {
		if ($this->active != 1){
			$this->active = 1;
			$this->save();
		}
		$activeDateConstraint = $this->activeDateConstraint();
		if ($activeDateConstraint) {
			$activeDateConstraint->delete();
		}
	}

	public function inactivate() {
		if ($this->active != 0) {
			$this->active = 0;
			$this->save();
		}
	}

	public function hasActiveDateConstraint($date = null) {
		foreach ($this->date_constraints as $dateConstraint) {
			if ($dateConstraint->isActive($date)){
				return true;
			}
		}
		return false;
	}

	public function activeDateConstraint($date = null) {
		foreach ($this->date_constraints as $dateConstraint) {
			if ($dateConstraint->isActive($date)){
				return $dateConstraint;
			}
		}
		return null;
	}

	/**
	 * @Override
	 * @param string $token
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification($token));
	}
}
