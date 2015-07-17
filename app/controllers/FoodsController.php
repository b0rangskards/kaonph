<?php

use Acme\Foods\AddMenuToRestaurantFormCommand;
use Acme\Forms\AddMenuToRestaurantForm;
use Acme\Forms\MakeFoodSpecialtyForm;
use Acme\Helpers\DataHelper;
use Acme\Helpers\ResponseHelper;
use Laracasts\Flash\Flash;

class FoodsController extends \BaseController {

	private $addMenuToRestaurantForm;

	private $makeFoodSpecialtyForm;

	function __construct(AddMenuToRestaurantForm $addMenuToRestaurantForm,
						 MakeFoodSpecialtyForm $makeFoodSpecialtyForm)
	{
		$this->addMenuToRestaurantForm = $addMenuToRestaurantForm;

		$this->makeFoodSpecialtyForm = $makeFoodSpecialtyForm;
	}


	/**
	 * Display a listing of the resource.
	 * GET /foods
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$data['restaurant'] = Restaurant::findOrFail($id);

		return View::make('foods.index', $data);
	}

	public function showEditMenu($id)
	{
		$data['restaurant'] = Restaurant::findOrFail($id);

		return View::make('foods.edit-menu', $data);
	}

	public function makeSpecialty($id)
	{
		try
		{
			$inputs = Input::all();
			$inputs['restaurant_id'] = $id;

			$this->makeFoodSpecialtyForm->validate($inputs);

			$foodId = Input::get('food_id');

			$restaurant = Restaurant::find($id);

			$food = Food::find($foodId);

			if ( !$restaurant->isOwner() ) return Redirect::back()->withErrors(['error' => 'User Unauthorized.']);

			FoodSpecialty::create([
				'restaurant_id' => $id,
				'food_id'       => $foodId
			]);

			Flash::overlay( $food->present()->prettyName . ' is now our new specialty.', 'Food Specialty');

			return Redirect::back();

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			Flash::overlay('Cannot make food as Specialty', 'Error Occured');

			return Redirect::back()->withErrors($exception->getErrors()->toArray());

		}
	}

	public function cancelSpecialty($id)
	{
		try {
			$foodId = Input::get('food_id');

			$restaurant = Restaurant::find($id);

			if ( !$restaurant->isOwner() ) return Redirect::back()->withErrors(['error' => 'User Unauthorized.']);

			$sp = FoodSpecialty::where('food_id', $foodId)->get();

			if($sp->isEmpty()) return Redirect::back()->withErrors(['error' => 'Cannot find food as specialty.']);

			$sp = $sp->first();

			$sp->delete();

			Flash::overlay('Cancelled specialty.', 'Food Specialty');

			return Redirect::back();

		} catch ( Laracasts\Validation\FormValidationException $exception ) {

			Flash::overlay('Cannot cancel food as Specialty', 'Error Occured');

			return Redirect::back()->withErrors($exception->getErrors()->toArray());

		}
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
	public function update($id)
	{
		//
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
		//
	}

}