<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(['before' => 'guest'], function () {
	// Home Page
	Route::get('/', [
		'as' => 'index',
		'uses' => 'PagesController@index'
	]);

	Route::post('/registration', [
		'as' => 'registration.public',
		'uses' => 'RegistrationController@store'
	]);

	Route::post('/owner/registration', [
		'as' => 'registration.owner',
		'uses' => 'OwnerRegistrationController@store'
	]);

	Route::post('/login', [
		'as' => 'sessions.store',
		'uses' => 'SessionsController@store'
	]);
});

Route::group(['before' => 'auth'], function () {

	Route::delete('/logout', [
		'as' => 'sessions.destroy',
		'uses' => 'SessionsController@destroy'
	]);
	/* Show Editable Restaurant Menu for Owner */
	Route::get('/restaurants/{id}/editmenu', [
		'as' => 'foods.editmenu',
		'uses' => 'FoodsController@showEditMenu'
	]);
	/*Make food as specialty*/
	Route::post('/restaurants/{id}/specialty', [
		'as' => 'foods.specialty',
		'uses' => 'FoodsController@makeSpecialty'
	]);
	/*Make food as specialty*/
	Route::post('/restaurants/{id}/despecialty', [
		'as' => 'foods.despecialty',
		'uses' => 'FoodsController@cancelSpecialty'
	]);

	Route::post('/restaurants/{id}/checkin', [
		'as' => 'restaurants.checkin',
		'uses' => 'RestaurantsController@checkin'
	]);

	/* Show Visited Restaurants */
	Route::get('/checkins', [
		'as' => 'restaurant_visits.index',
		'uses' => 'RestaurantVisitsController@index'
	]);

	Route::get('/checkins/getdata', [
		'as' => 'restaurant_visits.getdata',
		'uses' => 'RestaurantVisitsController@getData'
	]);

});



Route::get('/home', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

Route::get('/restaurants/getdata', [
	'as' => 'restaurants.getdata',
	'uses' => 'RestaurantsController@getData'
]);

Route::get('/restaurants/getdata/{id}', [
	'as'   => 'restaurants.find',
	'uses' => 'RestaurantsController@find'
]);



/* Show Restaurant Menu for Public Users */
Route::get('/restaurants/{id}/menu', [
	'as'   => 'foods.index',
	'uses' => 'FoodsController@index'
]);

Route::resource('restaurants', 'RestaurantsController');

Route::resource('foods', 'FoodsController', [
	'except' => ['index']
]);


Route::get('/test', function(){
	dd(Auth::user()->checkedInRestaurants()->toArray());
});

