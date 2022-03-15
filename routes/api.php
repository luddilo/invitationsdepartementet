<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/

Route::get('dashboard', [
    'as' => 'dashboard',
    'uses' => 'DashboardAPIController@getData'
]);

Route::get('dinners/calendar', [
    'as' => 'dinners.calendar',
    'uses' => 'DinnerAPIController@getDinnersForCalendar'
]);

Route::resource("dinners", "DinnerAPIController");

Route::resource("children", "ChildAPIController");

Route::resource("matches", "MatchAPIController");

Route::resource("preferences", "PreferenceAPIController");

Route::resource("roles", "RoleAPIController");

Route::resource("statuses", "StatusAPIController");

Route::get('users/all', [
    'as' => 'users.all',
    'uses' => 'UserAPIController@getAll'
]);

Route::get('users/established', [
    'as' => 'users.established',
    'uses' => 'UserAPIController@getEstablished'
]);

Route::get('users/new', [
    'as' => 'users.new',
    'uses' => 'UserAPIController@getNew'
]);

Route::get('users/ambassadors', [
    'as' => 'users.ambassadors',
    'uses' => 'UserAPIController@getAmbassadors'
]);

Route::get('users/guests', [
    'as' => 'users.guests',
    'uses' => 'UserAPIController@getSignedUpOnWeb'
]);

Route::get('users/clear-search', [
    'as' => 'users.clearsearch',
    'uses' => 'UserAPIController@clearSearch',
]);

Route::get('users/save-search', [
    'as' => 'users.savesearch',
    'uses' => 'UserAPIController@saveSearch',
]);

Route::resource("users", "UserAPIController");

Route::resource("regions", "RegionAPIController");

Route::resource("addresses", "AddressAPIController");
Route::get('addresses/user/{id}', [
    'as' => 'addresses.user',
    'uses' => 'AddressAPIController@getAddressByUser'
]);

Route::resource("regions", "RegionAPIController");

Route::resource("partners", "PartnerAPIController");

Route::resource("datepreferences", "DatepreferenceAPIController");

Route::resource("schools", "SchoolAPIController");

Route::resource("notes", "NoteAPIController");

Route::resource("notes", "NoteAPIController");

Route::resource("referrers", "ReferrerAPIController");