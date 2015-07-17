<?php  namespace Acme\Foods; 

class AddMenuToRestaurantFormCommand {

	public $name;
	public $restaurant;
	public $type;
	public $price;
	public $details;

	function __construct($name, $type, $restaurant, $price, $details)
	{
		$this->name = $name;
		$this->type = $type;
		$this->restaurant = $restaurant;
		$this->price = $price;
		$this->details = $details;
	}

} 