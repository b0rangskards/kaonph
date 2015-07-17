<?php

use Acme\Transformers\CustomersTransformer;

class RestaurantVisitsController extends \BaseController {

	protected $customerTransformer;

	function __construct(CustomersTransformer $customerTransformer)
	{
		$this->customerTransformer = $customerTransformer;
	}


	/**
	 * Display a listing of the resource.
	 * GET /restaurantvisits
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['checkedInRestaurants'] = Auth::user()->checkedInRestaurants();
		$data['checkedInRestaurantsHistory'] = Auth::user()->checkedInRestaurantsHistory();

		return View::make('restaurant_visits.index', $data);
	}

	public function getData()
	{
		$checkIns = Auth::user()->checkedInRestaurants();

		return Response::json([
			'data' => $this->customerTransformer->transformCollection($checkIns->all()),
			'marker' => Config::get('defaults.MARKER_CONTAINER_URL'),
			'defaultThumbnail' => Config::get('defaults.THUMBNAIL_URL')
		], 200);
	}
}