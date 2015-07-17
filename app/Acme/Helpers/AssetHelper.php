<?php  namespace Acme\Helpers; 

use Config;

class AssetHelper {

	public static function getFoodPhotoPath($restaurantName, $foodPhotoName)
	{
		return $foodPhotoName
			? asset('images/restaurants') . '/' . $restaurantName . '/' . $foodPhotoName
			: Config::get('constants.DEFAULT_RESTAURANT_LOGO_URL');
	}

} 