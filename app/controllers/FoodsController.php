<?php

use Acme\Foods\AddMenuToRestaurantFormCommand;
use Acme\Foods\FoodRepository;
use Acme\Foods\UpdateMenuCommand;
use Acme\Forms\AddMenuToRestaurantForm;
use Acme\Forms\MakeFoodSpecialtyForm;
use Acme\Forms\UpdateMenuForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;
use Acme\Transformers\FoodTransformer;
use Laracasts\Flash\Flash;

class FoodsController extends \BaseController {

	private $addMenuToRestaurantForm;

	private $updateMenuForm;

	private $makeFoodSpecialtyForm;

	private $repository;

	private $transformer;

	function __construct(FoodRepository $repository,
	                     FoodTransformer $transformer,
	                     AddMenuToRestaurantForm $addMenuToRestaurantForm,
	                     UpdateMenuForm $updateMenuForm,
						 MakeFoodSpecialtyForm $makeFoodSpecialtyForm)
	{
		$this->repository = $repository;

		$this->addMenuToRestaurantForm = $addMenuToRestaurantForm;

		$this->updateMenuForm = $updateMenuForm;

		$this->makeFoodSpecialtyForm = $makeFoodSpecialtyForm;

		$this->transformer = $transformer;
	}


	/**
	 * Display a listing of the resource.
	 * GET /foods
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$restaurant = Restaurant::with(['menu' => function($query){
			$query->with('type');
		}])
		->findOrFail($id);

		$data['restaurant'] = $restaurant;

		$data['foods']      = $restaurant->getFoodTypesAvailable();

		Log::info($data['foods']);

		return View::make('foods.index', $data);
	}

	public function showEditMenu($id)
	{
		$data['restaurant'] = Restaurant::findOrFail($id);
		$data['cancelledFoods'] = Restaurant::getCancelledFoods($id);

		return View::make('foods.edit-menu', $data);
	}

	public function makeSpecialty($id)
	{
		try
		{
			$inputs = Input::all();
			$inputs['restaurant_id'] = $id;

			$this->makeFoodSpecialtyForm->validate($inputs);

			// Cancel any food specialty if has one
			if($specialty = Restaurant::getFoodSpecialty($inputs['restaurant_id']))
			{
				$specialty = Food::cancelSpecialty($specialty->id);
				$this->repository->save($specialty);
			}

			$food = Food::makeSpecialty($inputs['food_id']);

			$this->repository->save($food);

			$message = [
				'message' => "You have a new specialty",
				'redirecTo' => URL::route('foods.editmenu', $food->restaurant_id)
			];

			return Response::json($message);

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			$error = DataHelper::getErrorDataFromException($exception);

			return Response::json($error, 400);
		}
	}

	public function cancelSpecialty($id)
	{
		$food = Food::cancelSpecialty(Input::get('food_id'));

		$this->repository->save($food);

		$message = [
			'message' => "You have currently no specialty. \n Please pick a new one.",
			'redirecTo' => URL::route('foods.editmenu', $food->restaurant_id)
		];

		return Response::json($message);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /foods
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			$this->addMenuToRestaurantForm->validate(Input::all());

			$this->execute(AddMenuToRestaurantFormCommand::class);

			$restaurantId = Input::get('restaurant');

			$message = ['message' => 'Congratulations! You have successfully opened new restaurant.',
				'redirecTo' => URL::route('foods.editmenu', $restaurantId)];

			return ResponseHelper::message($message);

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			$errors = DataHelper::getErrorDataFromException($exception);

			return ResponseHelper::errorMessage($errors);
		}
	}

	public function find($id)
	{
		$food = Food::with('restaurant')
			->find($id);

		if(!$food) return Response::json(['error' => 'Cannot find specified id'], 400);

		return Response::json([
			'data' => $this->transformer->transform($food->toArray())
		], 200);
	}

	/**
	 * Display the specified resource.
	 * GET /foods/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /foods/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /foods/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateMenu($id)
	{
		try {
			$this->updateMenuForm->validate(Input::all());

			$this->execute(UpdateMenuCommand::class);

			$restaurantId = Input::get('restaurant');

			$message = ['message' => 'You have Successfully updated your menu.',
				'redirecTo' => URL::route('foods.editmenu', $restaurantId)];

			return ResponseHelper::message($message);

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			$errors = DataHelper::getErrorDataFromException($exception);

			return ResponseHelper::errorMessage($errors);
		}
	}

	public function restoreFood($id)
	{
		$food = Food::offerFood(Input::get('food_id'));

		Log::info($food->name);

		$message = ['message' => 'Food Offered back on menu.',
			'redirecTo' => URL::route('foods.editmenu', $food->restaurant_id)];

		return Response::json($message);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /foods/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$food = Food::cancelFood($id);

		$message = ['message' => 'Food cancelled.',
					'redirecTo' => URL::route('foods.editmenu', $food->restaurant_id)];

		return Response::json($message);
	}

}