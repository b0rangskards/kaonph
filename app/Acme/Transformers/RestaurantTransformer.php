<?php  namespace Acme\Transformers; 

use Acme\Helpers\DataHelper;
use Acme\Helpers\UrlHelper;
use Config;
use Log;
use URL;

class RestaurantTransformer extends Transformer {

	public function transform($restaurant)
	{
		$array = [];

		$coords = DataHelper::getPointToLatLng($restaurant['coordinates']);

		if(!is_array($restaurant)) {
			$ratings = $restaurant->getRatings($restaurant->customers()->get(), $restaurant['id']);
			$array = [
				'loved_percentage'    => $ratings['loved_perc'],
				'liked_percentage'    => $ratings['liked_perc'],
				'disliked_percentage' => $ratings['disliked_perc'],
				'loved_count'         => $ratings['loved_total'],
				'liked_total'         => $ratings['liked_total'],
				'disliked_total'      => $ratings['disliked_total']
				];
		}else{
			$array = [
				'loved_percentage' => 0,
				'liked_percentage' => 0,
				'disliked_percentage' => 0,
				'loved_count' => 0,
				'liked_total' => 0,
				'disliked_total' => 0
			];
		}

		return array_merge($array, [
			'id'                  => $restaurant['id'],
			'name'                => ucwords($restaurant['name']),
			'address'             => ucwords($restaurant['address']),
			'type'                => ucwords($restaurant['type']),
			'contact'             => $restaurant['contact_no'],
			'image'               => $restaurant['logo'] ? UrlHelper::getRestaurantImageUrl($restaurant['logo']) : Config::get('constants.DEFAULT_RESTAURANT_LOGO_URL'),
			'lat'                 => $coords[0],
			'lng'                 => $coords[1],
			'marker_image'        => $restaurant['logo'] ? UrlHelper::getRestaurantThumbnailUrl($restaurant['logo']) : Config::get('defaults.THUMBNAIL_URL'),
			'url_more_info'       => URL::route('restaurants.show', $restaurant['id'])
		]);
	}


} 