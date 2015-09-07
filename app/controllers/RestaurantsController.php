<?php

use Acme\CheckIns\CheckInCommand;
use Acme\Forms\CheckinForm;
use Acme\Forms\NewRestaurantForm;
use Acme\Forms\UpdateRestaurantDetailsForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;
use Acme\Restaurants\NewRestaurantCommand;
use Acme\Restaurants\RestaurantRepository;
use Acme\Restaurants\UpdateRestaurantDetailsCommand;
use Acme\Transformers\RestaurantTransformer;
use Illuminate\Support\Facades\Response;

class RestaurantsController extends \BaseController {

	private $newRestaurantForm;

	private $updateRestaurantDetailsForm;

	private $restaurantTransformer;

	private $checkinForm;

	private $repository;

	function __construct(NewRestaurantForm $newRestaurantForm,
	                     UpdateRestaurantDetailsForm $updateRestaurantDetailsForm,
	                     RestaurantTransformer $restaurantTransformer,
	                     CheckinForm $checkinForm,
	                     RestaurantRepository $repository)
	{
		$this->beforeFilter('auth', ['only' => ['index', 'store', 'updateRestaurantDetails']]);

		$this->repository = $repository;

		$this->newRestaurantForm = $newRestaurantForm;

		$this->restaurantTransformer = $restaurantTransformer;

		$this->checkinForm = $checkinForm;

		$this->updateRestaurantDetailsForm = $updateRestaurantDetailsForm;
	}

	/**
	 * Display a listing of the resource.
	 * GET /restaurants
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$data['restaurants'] = Restaurant::where('owner_id', $user->id)->latest()->get();
		$data['closedRestaurants'] = Auth::user()->closedRestaurants();

		return View::make('restaurants.index', $data);
	}

	public function getData()
	{
		$restaurants = $this->repository->getRestaurantsWithCustomer();

		return Response::json([
			'data'              => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker'            => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail'  => Config::get('defaults.THUMBNAIL_URL')
 		], 200);
	}

	public function find($id)
	{
		$restaurant = Restaurant::with('customers')->findOrFail($id);

		return Response::json([
			'data'             => $this->restaurantTransformer->transform($restaurant->toArray()),
			'marker'           => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		],200);
	}


	public function searchMap()
	{
		$query = Input::get('q');

		$restaurants = Restaurant::with('customers')
								->where('name', 'like', "%$query%")
								->get();

		if($restaurants->isEmpty()) return Response::json(['message' => 'No Results Found.'], 200);

		return Response::json([
			'data' => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	public function searchResults($q)
	{
		$data['query'] = $q;

		$data['results'] = Restaurant::where('name', 'like', "%$q%")->get();

		return View::make('restaurants.search-results', $data);
	}

	public function getByName()
	{
		$restaurant = Restaurant::whereName(strtolower(Input::get('name')))->get();

		if($restaurant->isEmpty()) return Response::json(['message' => 'Restaurant Not Found.'], 200);

		return Response::json([
			'data' => $this->restaurantTransformer->transform($restaurant->first()->toArray()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	public function getByType()
	{
		$type = strtolower(Input::get('type'));

		$restaurants = Restaurant::whereType($type)->get();

		if ( $restaurants->isEmpty() ) return Response::json(['message' => "There were no $type restaurants."], 200);

		return Response::json([
			'data' => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurants
	 *
	 * @return Response
	 */
	public function store()
	{
	  try
	  {
	      $this->newRestaurantForm->validate(Input::all());

	      $this->execute(NewRestaurantCommand::class);

	      $message = ['message'   => 'Congratulations! You have successfully opened new restaurant.',
	                  'redirecTo' => URL::route('home')];

	      return ResponseHelper::message($message);

	  } catch ( Laracasts\Validation\FormValidationException $exception ) {

	      $errors = DataHelper::getErrorDataFromException($exception);

	      return ResponseHelper::errorMessage($errors);
	  }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function updateRestaurantDetails()
	{
		try {
			$this->updateRestaurantDetailsForm->validate(Input::all());

			$this->execute(UpdateRestaurantDetailsCommand::class);

			$message = ['message'   => 'You have successfully updated your restaurant details.',
						'redirecTo' => URL::route('restaurants.index')];

			return ResponseHelper::message($message);

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			$errors = DataHelper::getErrorDataFromException($exception);

			return ResponseHelper::errorMessage($errors);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /restaurants/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$restaurant = Restaurant::with('customers')->findOrFail($id);

		$data['similar'] = Restaurant::whereType($restaurant->type)
									->where('id', '!=', $id)
									->get();

		$data['visitors'] = $restaurant->getVisitors();
		$data['visitorsList'] = $restaurant->getVisitorsListName();

		$data['lovedCustomersList'] = $restaurant->getLovedCustomersList();
		$data['justFineCustomersList'] = $restaurant->getJustFineCustomersList();
		$data['dislikeCustomersList'] = $restaurant->getDislikeCustomersList();

		$data['restaurant'] = $restaurant;

		if( !$restaurant->customers()->get()->isEmpty())
			$data['ratings'] = $restaurant->getRatings(Customer::where('restaurant_id', $restaurant->id)->get(), $restaurant->id);

		return View::make('restaurants.show', $data);
	}

	public function checkin()
	{
		try {
			$this->checkinForm->validate(Input::all());

			$this->execute(CheckInCommand::class);

			$message = ['message' => 'Checked In!',
				'redirecTo' => URL::route('restaurants.show', Input::get('restaurant_id'))];

			return ResponseHelper::message($message);

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			$errors = DataHelper::getErrorDataFromException($exception);

			return ResponseHelper::errorMessage($errors);
		}
	}

	public function getAllLoved()
	{
		$restaurants = $this->repository->getAllLovedRestaurants();

		if(count($restaurants) == 0) return Response::json(['message' => 'No Loved Restaurants at the moment.']);

		return Response::json([
			'data' => $this->restaurantTransformer->transformCollection($restaurants),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	public function getLoved()
	{
		if( !Auth::check()) return Response::json(['message' => 'Please Login To Contine']);

		$restaurants = $this->repository->getLovedRestaurants(Auth::user()->id);

		if ( count($restaurants) == 0 ) return Response::json(['message' => 'No Loved Restaurants at the moment.']);

		return Response::json([
			'data' => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	public function getLiked()
	{
		if ( !Auth::check() ) return Response::json(['message' => 'Please Login To Contine']);

		$restaurants = $this->repository->getLikedRestaurants(Auth::user()->id);

		if ( count($restaurants) == 0 ) return Response::json(['message' => 'No Liked Restaurants at the moment.']);

		return Response::json([
			'data' => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	public function getDisliked()
	{
		if ( !Auth::check() ) return Response::json(['message' => 'Please Login To Contine']);

		$restaurants = $this->repository->getDislikedRestaurants(Auth::user()->id);

		if ( count($restaurants) == 0 ) return Response::json(['message' => 'No Disliked Restaurants at the moment.']);

		return Response::json([
			'data' => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}

	public function getPlaces()
	{
		$this->repository->getPlacesByCurl();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /restaurants/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$restaurant = Restaurant::closeRestaurant($id);

		$message = ['message' => $restaurant->present()->prettyName." closed.",
					'redirecTo' => URL::route('restaurants.index')];

		return Response::json($message);
	}

	public function reopen($id)
	{
		$restaurant = Restaurant::reOpenRestaurant($id);

		$message = ['message'   => $restaurant->present()->prettyName . " Re-Opened.",
					'redirecTo' => URL::route('restaurants.index')];

		return Response::json($message);
	}

	public function visitorsHistory($id)
	{
		$data['restaurant'] = Restaurant::findOrFail($id);
		$data['visitors'] = $data['restaurant']->getVisitors();

		return View::make('restaurants.visitors-history', $data);
	}




}