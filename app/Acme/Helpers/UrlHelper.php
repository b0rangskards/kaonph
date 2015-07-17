<?php  namespace Acme\Helpers; 

use Config;
use URL;

class UrlHelper {

	public static function getRestaurantImageUrl($photoFileName)
	{
		return Config::get('constants.RESTAURANT_LOGO_URL').$photoFileName;
	}

	public static function getRestaurantThumbnailUrl($photoFileName)
	{
		return Config::get('constants.RESTAURANT_THUMBNAIL_URL') .'tmb_'. $photoFileName;
	}

} 