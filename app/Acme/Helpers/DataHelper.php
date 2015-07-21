<?php  namespace Acme\Helpers; 

class DataHelper {

    public static function arrayToString($array)
    {
        $str = "";

        foreach ( $array as $a ) {
            if ( !is_array($a) )
            {
                $str .= $a . '<br/>';
                continue;
            }

            foreach ( $a as $c ) {
                $str .= $c . '<br/>';
            }
        }
        return $str;
    }

    public static function getErrorDataFromException($exception)
    {
        return is_object($exception->getErrors())
            ? $exception->getErrors()->toArray()
            : $exception->getErrors();
    }

	/**
	 * @param $point
	 * @return array
	 */
	public static function getPointToLatLng($point)
	{
		return explode(',', $point);
	}

	public static function getRestaurantsByCurl()
	{
		$details_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?";
		$details_url .= "location=10.30739,123.89728&radius=10000&types=restaurant&sensor=false&key=AIzaSyAsHVLxS6qsR00VdIbOpwnjZD5oeoRlHHg";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $details_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($curl);
		curl_close($curl);

		$result = json_decode($response, true);
		$places = [];

		foreach ( $result['results'] as $placeAssoc ) {
			$tempArray = [];

			$tempArray['name'] = $placeAssoc['name'];
			$tempArray['address'] = $placeAssoc['vicinity'];
			$tempArray['coordinates'] = $placeAssoc['geometry']['location'];

			$places[] = $tempArray;
		}
		
		return $places;
	}

} 