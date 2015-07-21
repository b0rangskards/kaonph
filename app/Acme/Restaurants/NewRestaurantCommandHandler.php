<?php  namespace Acme\Restaurants; 

use Acme\Helpers\FileHelper;
use Auth;
use Config;
use File;
use Input;
use Intervention\Image\Facades\Image;
use Laracasts\Commander\CommandHandler;
use Log;
use Restaurant;

class NewRestaurantCommandHandler implements CommandHandler {

	private $repository;

	function __construct(RestaurantRepository $repository)
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
		$ownerId = Auth::user()->id;

		$restaurant = Restaurant::newRestaurant(
		    $ownerId,
			$command->name,
		    $command->address,
		    $command->type,
		    $command->coordinates,
		    $command->contact_no
		);

		if ( Input::hasFile('logo') )
		{
		    $file = Input::file('logo');

		    $fileName = FileHelper::generateLogoFileName(Input::get('name'), $file);

			$image = Image::make($file->getRealPath());

			File::exists(Config::get('constants.RESTAURANT_THUMBNAIL_PATH')) or File::makeDirectory(Config::get('constants.RESTAURANT_THUMBNAIL_PATH'));

			$image
				->resize(220, 180, function($constraint){
					$constraint->upsize();
				})
				->save(Config::get('constants.RESTAURANT_LOGO_PATH') . $fileName)
				->resize(32, 32)
				->save(Config::get('constants.RESTAURANT_THUMBNAIL_PATH') . FileHelper::generateThumbnailFileName($fileName));

		    $restaurant->logo = $fileName;
		}

		$this->repository->save( $restaurant);

		return $restaurant;
	}
}