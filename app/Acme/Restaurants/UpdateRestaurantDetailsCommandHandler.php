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

class UpdateRestaurantDetailsCommandHandler implements CommandHandler {

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
		$restaurant = Restaurant::updateRestaurant(
			$command->id,
			$command->name,
			$command->address,
			$command->type,
			$command->contact_no,
			$command->coordinates
		);

		if ( Input::hasFile('logo') )
		{
			$currentLogoFilePath = Config::get('constants.RESTAURANT_LOGO_PATH') . $restaurant->logo;
			$currentThumbnailFilePath = Config::get('constants.RESTAURANT_THUMBNAIL_PATH') . FileHelper::generateThumbnailFileName($restaurant->logo);

			// Delete old photos to be replaced
			if ( !empty($restaurant->logo) ) {
				if ( File::exists($currentLogoFilePath) ) File::delete($currentLogoFilePath);
				if ( File::exists($currentThumbnailFilePath) ) File::delete($currentThumbnailFilePath);
			}

			$file = Input::file('logo');

			$fileName = FileHelper::generateLogoFileName(Input::get('name'), $file);

			$image = Image::make($file->getRealPath());

			File::exists(Config::get('constants.RESTAURANT_THUMBNAIL_PATH')) or File::makeDirectory(Config::get('constants.RESTAURANT_THUMBNAIL_PATH'));

			$logoPath = Config::get('constants.RESTAURANT_LOGO_PATH') . $fileName;
			$thumbnailPath = Config::get('constants.RESTAURANT_THUMBNAIL_PATH') . FileHelper::generateThumbnailFileName($fileName);

			$image
				->resize(220, 180, function ($constraint) {
					$constraint->upsize();
				})
				->save($logoPath)
				->resize(32, 32)
				->save($thumbnailPath);

			$restaurant->logo = $fileName;
		}

		$this->repository->save($restaurant);

		return $restaurant;
	}
}