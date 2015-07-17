<?php  namespace Acme\Restaurants; 

class NewRestaurantCommand {

	public $name;

	public $address;

	public $coordinates;

	public $type;

	public $contact_no;


	function __construct($name, $address, $type, $contact_no, $coordinates)
	{
		$this->name = $name;
		$this->address = $address;
		$this->type = $type;
		$this->contact_no = $contact_no;
		$this->coordinates = $coordinates;
	}

}