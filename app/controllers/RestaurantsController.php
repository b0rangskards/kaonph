<?php

use Acme\CheckIns\CheckInCommand;
use Acme\Forms\CheckinForm;
use Acme\Forms\NewRestaurantForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;
use Acme\Restaurants\NewRestaurantCommand;
use Acme\Transformers\RestaurantTransformer;

class RestaurantsController extends \BaseController {

	private $newRestaurantForm;

	private $restaurantTransformer;

	private $checkinForm;

	function __construct(NewRestaurantForm $newRestaurantForm,
	                     RestaurantTransformer $restaurantTransformer,
	                     CheckinForm $checkinForm)
	{
		$this->newRestaurantForm = $newRestaurantForm;

		$this->restaurantTransformer = $restaurantTransformer;

		$this->checkinForm = $checkinForm;
	}

	public function getData()
	{
		$restaurants = Restaurant::all();
		return Response::json([
			'data'              => $this->restaurantTransformer->transformCollection($restaurants->all()),
			'marker'            => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail'  => Config::get('defaults.THUMBNAIL_URL')
 		], 200);
	}

	public function find($id)
	{
		$restaurant = Restaurant::findOrFail($id);

		return Response::json([
			'data'             => $this->restaurantTransformer->transform($restaurant->toArray()),
			'marker'           => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		],200);
	}

	/**
	 * Display a listing of the resource.
	 * GET /restaurants
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['restaurants'] = Auth::user()->restaurants()->get();

		return View::make('restaurants.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /restaurants/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	 * Display the specified resource.
	 * GET /restaurants/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$restaurant = Restaurant::findOrFail($id);

		$data['similar'] = Restaurant::whereType($restaurant->type)
									->where('id', '!=', $id)
									->get();

		$data['visitors'] = $restaurant->getVisitors();
		$data['visitorsList'] = $restaurant->getVisitorsListName();

		$data['restaurant'] = $restaurant;

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

	/**
	 * Update the specified resource in storage.
	 * PUT /restaurants/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		//
	}




}