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

} 