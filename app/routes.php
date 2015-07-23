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

/* Public Routes for Member/Guest */

use Acme\Restaurants\RestaurantRepository;

/* Member Routes */

Route::group(['before' => 'auth'], function () {

	Route::delete('/logout', [
		'as'   => 'sessions.destroy',
		'uses' => 'SessionsController@destroy'
	]);
	/* Show Editable Restaurant Menu for Owner */
	Route::get('/restaurants/{id}/editmenu', [
		'as'   => 'foods.editmenu',
		'uses' => 'FoodsController@showEditMenu'
	]);
	/*Make food as specialty*/
	Route::post('/restaurants/{id}/specialty', [
		'as'   => 'foods.specialty',
		'uses' => 'FoodsController@makeSpecialty'
	]);
	/*Make food as specialty*/
	Route::post('/restaurants/{id}/despecialty', [
		'as'   => 'foods.despecialty',
		'uses' => 'FoodsController@cancelSpecialty'
	]);

	Route::put('/restaurants/{id}/foods/restore', [
		'as'   => 'foods.restore',
		'uses' => 'FoodsController@restoreFood'
	]);

	Route::post('/restaurants/{id}/foods/edit', [
		'as'   => 'foods.updatemenu',
		'uses' => 'FoodsController@updateMenu'
	]);

	Route::post('/restaurants/{id}/checkin', [
		'as'   => 'restaurants.checkin',
		'uses' => 'RestaurantsController@checkin'
	]);

	Route::put('/restaurants/{id}/reopen', [
		'as'    => 'restaurants.reopen',
		'uses'  => 'RestaurantsController@reopen'
	]);

	Route::post('/restaurants/updatedetails', [
		'as'   => 'restaurants.updatedetails',
		'uses' => 'RestaurantsController@updateRestaurantDetails'
	]);

	/* Show Visited Restaurants */
	Route::get('/checkins', [
		'as'   => 'restaurant_visits.index',
		'uses' => 'RestaurantVisitsController@index'
	]);

	Route::get('/checkins/getdata', [
		'as'   => 'restaurant_visits.getdata',
		'uses' => 'RestaurantVisitsController@getData'
	]);

	Route::get('/places', [
		'as'   => 'restaurants.places',
		'uses' => 'RestaurantsController@getPlaces'
	]);
});


/* Guest Routes */

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

Route::get('/home', [
    'as'   => 'home',
    'uses' => 'PagesController@home'
]);

Route::get('/search', [
	'as'   => 'restaurants.mapsearch',
	'uses' => 'RestaurantsController@searchMap'
]);

Route::get('/search-results/{q}', [
	'as' => 'restaurants.searchresults',
	'uses' => 'RestaurantsController@searchResults'
]);

Route::get('/restaurants/getbyname', [
	'as'   => 'restaurants.getbyname',
	'uses' => 'RestaurantsController@getByName'
]);

Route::get('/restaurants/getdata', [
	'as'   => 'restaurants.getdata',
	'uses' => 'RestaurantsController@getData'
]);

Route::get('/restaurants/getallloved', [
	'as'   => 'restaurants.getallloved',
	'uses' => 'RestaurantsController@getAllLoved'
]);

Route::get('/restaurants/getloved', [
	'as' => 'restaurants.getloved',
	'uses' => 'RestaurantsController@getLoved'
]);

Route::get('/restaurants/getliked', [
	'as' => 'restaurants.getliked',
	'uses' => 'RestaurantsController@getLiked'
]);

Route::get('/restaurants/getdisliked', [
	'as' => 'restaurants.getdisliked',
	'uses' => 'RestaurantsController@getDisliked'
]);

Route::get('/restaurants/getdata/{id}', [
	'as'   => 'restaurants.find',
	'uses' => 'RestaurantsController@find'
]);

Route::get('resturants/getbytype', [
	'as'   => 'restaurants.getbytype',
	'uses' => 'RestaurantsController@getByType'
]);

/* Show Restaurant Menu for Public Users */
Route::get('/restaurants/{id}/menu', [
	'as'   => 'foods.index',
	'uses' => 'FoodsController@index'
]);

Route::get('/foods/{id}' , [
	'as'   => 'foods.find',
	'uses' => 'FoodsController@find'
]);

Route::resource('restaurants', 'RestaurantsController', [
	'except' => ['update']
]);

Route::resource('foods', 'FoodsController', [
	'except' => ['index', 'update']
]);

Route::get('/test', function(){
	$repo = new RestaurantRepository();

	$restaus = $repo->getLovedRestaurants(Auth::user()->id);

	dd($restaus->toArray());
});
