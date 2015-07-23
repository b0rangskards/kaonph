<?php  namespace Acme\Foods; 

use Acme\Helpers\FileHelper;
use Config;
use Food;
use Input;
use Laracasts\Commander\CommandHandler;
use Restaurant;

class AddMenuToRestaurantFormCommandHandler implements CommandHandler {

	protected $repository;

	function __construct(FoodRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$restaurant = Restaurant::find($command->restaurant);

		$food = Food::newMenu(
			$command->restaurant,
			$command->type,
			$command->name,
			$command->price,
			$command->details
		);

		if(Input::has('is_specialty') && Input::get('is_specialty') === 'on') $food->is_specialty = 1;

		if ( Input::hasFile('picture') )
		{
			$file = Input::file('picture');

			$fileName = FileHelper::generateLogoFileName(Input::get('name'), $file);

			$file->move(Config::get('constants.RESTAURANT_LOGO_PATH') . '/' . $restaurant->name, $fileName);

			$food->picture = $fileName;
		}

		$this->repository->save( $food);

		return $food;
	}
}