<?php  namespace Acme\CheckIns; 

class CheckInCommand {

	public $restaurant_id;

	public $rating;

	function __construct($restaurant_id, $rating)
	{
		$this->restaurant_id = $restaurant_id;
		$this->rating = $rating;
	}

} 