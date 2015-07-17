<?php  namespace Acme\Transformers; 

use Acme\Helpers\DataHelper;
use Acme\Helpers\UrlHelper;
use Config;
use URL;

class RestaurantTransformer extends Transformer {

	public function transform($restaurant)
	{
		$coords = DataHelper::getPointToLatLng($restaurant['coordinates']);

		return [
			'id'            => $restaurant['id'],
			'name'          => ucwords($restaurant['name']),
			'address'       => ucwords($restaurant['address']),
			'type'          => ucwords($restaurant['type']),
			'contact'       => $restaurant['contact_no'],
			'image'         => $restaurant['logo'] ? UrlHelper::getRestaurantImageUrl($restaurant['logo']) : Config::get('constants.DEFAULT_RESTAURANT_LOGO_URL'),
			'lat'           => $coords[0],
			'lng'           => $coords[1],
			'marker_image'  => $restaurant['logo'] ? UrlHelper::getRestaurantThumbnailUrl($restaurant['logo']) : Config::get('defaults.THUMBNAIL_URL'),
			'url_more_info' => URL::route('restaurants.show', $restaurant['id'])
		];
	}


} 