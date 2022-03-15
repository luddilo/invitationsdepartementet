<?php

/*
|--------------------------------------------------------------------------
| LANDING route
|--------------------------------------------------------------------------
*/

Route::get('/', [ 'as' => 'landing', function () {

    if (Auth::guest()){
        return redirect('/signup');
    }
    return redirect('/app');
}]);

Route::get('home', function() {
    return redirect('/');
});
/*
|--------------------------------------------------------------------------
| AUTH routes
|--------------------------------------------------------------------------
*/
Route::auth();
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

/*
|--------------------------------------------------------------------------
| EXTERNAL SIGNUP routes
|--------------------------------------------------------------------------
*/

Route::get('signup', ['as' => 'signup', 'uses' => 'UserController@getSignup']);
Route::get('signup/{region?}', ['as' => 'signup', 'uses' => 'UserController@getSignup']);
Route::post('signup', ['as' => 'post_signup', 'uses' => 'UserController@postSignup']);
Route::get('confirmation/{uuid}', ['as' => 'signup_confirmation', 'uses' => 'UserController@getConfirmation']);
Route::get('dateselection/another', ['as' => 'apply_for_another_dinner', 'uses' => 'DinnerController@dateSelectionAnother']);
Route::get('dateselection/select_later/{uuid}', ['as' => 'dateselection.select_later', 'uses' => 'DinnerController@selectDateLater']);
Route::get('dateselection/{uuid}/{another?}', ['as' => 'dateselection', 'uses' => 'DinnerController@dateSelection']);
Route::post('dateselection/another/email', ['as' => 'post_dateselection_another', 'uses' => 'DinnerController@postDateSelectionAnotherEmail']);
Route::post('dateselection', ['as' => 'post_dateselection', 'uses' => 'DinnerController@postDateSelection']);
Route::get('test', function () {
    return view('outside.dateselection_confirmation');
});

/*
|--------------------------------------------------------------------------
| SECURED routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => 'auth'], function() {

    /*
    |--------------------------------------------------------------------------
    | FOR ALL USER ROLES
    |--------------------------------------------------------------------------
    */

    Route::get('/', function(){
        return redirect()->route('app.dashboard');
    });

    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@getIndex'
    ]);

    Route::get('/profile', [
        'as' => 'profile',
        'uses' => 'UserController@showProfile'
    ]);

    /*
    |--------------------------------------------------------------------------
    | FOR ADMIN AND AMBASSADOR ROLES
    |--------------------------------------------------------------------------
    */

    Route::group(['middleware' => ['roles'], 'roles' => ['Ambassador', 'Administrator']], function() {

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::get('/users/established', [
            'as' => 'users.established',
            'uses' => 'UserController@indexEstablished',
            'middleware' => ['roles'],
            'roles' => ['Ambassador', 'Administrator']
        ]);

        Route::get('/users/new', [
            'as' => 'users.new',
            'uses' => 'UserController@indexNew'
        ]);

        Route::get('/users/ambassadors', [
            'as' => 'users.ambassadors',
            'uses' => 'UserController@indexAmbassadors'
        ]);

        Route::get('/users/guests', [
            'as' => 'users.guests',
            'uses' => 'UserController@indexGuests'
        ]);

        Route::resource('users', 'UserController');

        Route::get('users/{id}/delete', [
            'as' => 'users.delete',
            'uses' => 'UserController@destroy',
        ]);

        Route::get('users/{id}/activate', [
            'as' => 'users.activate',
            'uses' => 'UserController@activate',
        ]);

        Route::get('users/{id}/inactivate', [
            'as' => 'users.inactivate',
            'uses' => 'UserController@inactivate',
        ]);

        Route::get('users/{id}/dinners/', [
            'as' => 'users.dinners',
            'uses' => 'DinnerController@getDinnersByUser'
        ]);

        Route::get('users/{id}/dinners/create', [
            'as' => 'users.dinners.create',
            'uses' => 'DinnerController@newDinnerByUser'
        ]);

        Route::get('users/{id}/notes', [
            'as' => 'users.notes',
            'uses' => 'NoteController@getByUser'
        ]);

        Route::get('users/{user_id}/region/set/{region_id}', [
            'as' => 'user.region.edit',
            'uses' => 'UserController@setRegionForUser'
        ]);

        Route::get('users/{id}/matches', [
            'as' => 'users.matches',
            'uses' => 'UserController@getMatchesForUser']);

        Route::get('users/{id}/matches/refresh', [
            'as' => 'users.matches.refresh',
            'uses' => 'UserController@getNewMatchesForUser']);

        /*
        |--------------------------------------------------------------------------
        | LISTS
        |--------------------------------------------------------------------------
        */
        Route::get('lists/not_booked_yet', [
            'as' => 'lists.not_booked_yet',
            'uses' => 'ListController@notBookedYet',
        ]);

        Route::get('lists/christmas', [
            'as' => 'lists.christmas',
            'uses' => 'ListController@christmas',
        ]);

        Route::get('lists/booking_time', [
            'as' => 'lists.booking_time',
            'uses' => 'ListController@bookingTime',
        ]);

        Route::resource('stats', 'StatsController', ['only' => ['index']]);

        /*
        |--------------------------------------------------------------------------
        | DINNERS
        |--------------------------------------------------------------------------
        */

        Route::get('dinners/calendar', [
            'as' => 'dinners.calendar',
            'uses' => 'DinnerController@getCalendar'
        ]);

        Route::get('dinners/matched', [
            'as' => 'dinners.matched',
            'uses' => 'DinnerController@getMatched'
        ]);

        Route::get('dinners/unmatched', [
            'as' => 'dinners.unmatched',
            'uses' => 'DinnerController@getUnMatched'
        ]);

        Route::resource('dinners', 'DinnerController');

        Route::get('dinners/{id}/delete', [
            'as' => 'dinners.delete',
            'uses' => 'DinnerController@destroy',
        ]);

        Route::get('dinners/{id}/activate', [
            'as' => 'dinners.activate',
            'uses' => 'DinnerController@activate',
        ]);
        Route::get('dinners/{id}/cancel', [
            'as' => 'dinners.cancel',
            'uses' => 'DinnerController@cancel',
        ]);

        Route::get('dinners/{id}/matches', [
            'as' => 'dinners.matches',
            'uses' => 'UserController@getMatchesForDinner']);

        Route::get('dinners/{id}/matches/refresh', [
            'as' => 'dinners.matches.refresh',
            'uses' => 'UserController@getNewMatchesForDinner']);

        /*
        |--------------------------------------------------------------------------
        | MATCHES
        |--------------------------------------------------------------------------
        */

        Route::resource('matches', 'MatchController');

        //create_and_approve
        Route::get('matches/create_and_approve/{dinner_id}/{user_id}', [
            'as' => 'matches.create_and_approve',
            'uses' => 'MatchController@createAndApprove']);

        Route::get('matches/{id}/approve', [
            'as' => 'matches.approve',
            'uses' => 'MatchController@approveMatch']);

        Route::get('matches/{id}/deny', [
            'as' => 'matches.deny',
            'uses' => 'MatchController@denyMatch']);

        Route::get('matches/{id}/preview_email/{email_type?}', [
            'as' => 'matches.preview_email',
            'uses' => 'MatchController@previewEmail']);

        Route::post('matches/{id}/send_email', [
            'as' => 'matches.send_email',
            'uses' => 'MatchController@sendEmail']);


        Route::get('matches/{id}/delete', [
            'as' => 'matches.delete',
            'uses' => 'MatchController@destroy',
        ]);

        /*
        |--------------------------------------------------------------------------
        | OTHER
        |--------------------------------------------------------------------------
        */

        Route::resource('preferences', 'PreferenceController');

        Route::get('preferences/{id}/delete', [
            'as' => 'preferences.delete',
            'uses' => 'PreferenceController@destroy',
        ]);

        Route::resource('roles', 'RoleController');

        Route::get('roles/{id}/delete', [
            'as' => 'roles.delete',
            'uses' => 'RoleController@destroy',
        ]);


        Route::resource('statuses', 'StatusController');

        Route::get('statuses/{id}/delete', [
            'as' => 'statuses.delete',
            'uses' => 'StatusController@destroy',
        ]);

        Route::resource('children', 'ChildController');

        Route::get('children/{id}/delete', [
            'as' => 'children.delete',
            'uses' => 'ChildController@destroy',
        ]);


        Route::resource('regions', 'RegionController');

        Route::get('regions/{id}/delete', [
            'as' => 'regions.delete',
            'uses' => 'RegionController@destroy',
        ]);

        Route::resource('emailtemplates', 'EmailTemplateController');

        Route::get('emailtemplates/{id}/delete', [
            'as' => 'emailtemplates.delete',
            'uses' => 'EmailTemplateController@destroy',
        ]);

        Route::resource('addresses', 'AddressController');

        Route::get('addresses/{id}/delete', [
            'as' => 'addresses.delete',
            'uses' => 'AddressController@destroy',
        ]);


        Route::resource('partners', 'PartnerController');

        Route::get('partners/{id}/delete', [
            'as' => 'partners.delete',
            'uses' => 'PartnerController@destroy',
        ]);

        Route::resource('datepreferences', 'DatepreferenceController');

        Route::get('datepreferences/{id}/delete', [
            'as' => 'datepreferences.delete',
            'uses' => 'DatepreferenceController@destroy',
        ]);

        Route::resource('date_constraints', 'DateConstraintController');

        Route::get('date_constraints/{id}/delete', [
            'as' => 'date_constraints.delete',
            'uses' => 'DateConstraintController@destroy',
        ]);


        Route::resource('schools', 'SchoolController');

        Route::get('schools/{id}/delete', [
            'as' => 'schools.delete',
            'uses' => 'SchoolController@destroy',
        ]);

        Route::resource('notes', 'NoteController');

        Route::get('notes/{id}/delete', [
            'as' => 'notes.delete',
            'uses' => 'NoteController@destroy',
        ]);

        Route::resource('referrers', 'ReferrerController');

        Route::get('referrers/{id}/delete', [
            'as' => 'referrers.delete',
            'uses' => 'ReferrerController@destroy',
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | FOR SUPER-ADMIN
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['roles'], 'roles' => ['SuperAdministrator']], function () {
        Route::resource('emails', 'EmailController');
    });
});

/*
|--------------------------------------------------------------------------
| TEST routes
|--------------------------------------------------------------------------
*/

Route::get('test/welcomeemail/{region}/{guest_or_host}/', function($region, $guest_or_host = 'host'){

    $preview = false;

    // For testing only
    $region_id = App\Models\Region::where('name', $region)->first()->id;
    $user = App\Models\User::where('region_id', $region_id)->first();
    $user->wants_to_host = $guest_or_host = 'host' ? 1 : 0;
    $dinner =App\Models\Dinner::first();
    $email_type = 5;
    $data = [
        'user' => $user,
        'sender' => $user->region->responsible_user,
        'dinner' => $dinner
    ];

    $success = App\Libraries\EmailSender::sendEmailFromTemplate($email_type, $data, $preview);
    return $preview ? $success : $success ? "success" : "fail";
});





