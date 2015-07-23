<?php  namespace Acme\Foods; 

use Acme\Helpers\FileHelper;
use Config;
use File;
use Food;
use Input;
use Laracasts\Commander\CommandHandler;
use Restaurant;

class UpdateMenuCommandHandler implements CommandHandler {

	private $repository;

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
		$food = Food::updateMenu(
			$command->id,
			$command->type,
			$command->name,
			$command->price,
			$command->details
		);

		$restaurant = Restaurant::find(Input::get('restaurant'));

		if ( Input::hasFile('picture') )
		{
			$file = Input::file('picture');

			$fileName = FileHelper::generateLogoFileName(Input::get('name'), $file);

			$restauFilePath = Config::get('constants.RESTAURANT_LOGO_PATH') . '/' . strtolower($restaurant->name);

			$file->move($restauFilePath, $fileName);

			$picturePath = $restauFilePath . '/' . $food->picture;

			if(File::exists($picturePath)) File::delete($picturePath);

			$food->picture = $fileName;
		}

		$this->repository->save($food);

		return $food;
	}
}