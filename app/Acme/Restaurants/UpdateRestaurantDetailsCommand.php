<?php  namespace Acme\Restaurants; 

class UpdateRestaurantDetailsCommand {

	public $id;

	public $name;

	public $address;

	public $type;

	public $contact_no;

	public $coordinates;

	function __construct($id, $name, $type, $contact_no, $address, $coordinates)
	{
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->contact_no = $contact_no;
		$this->address = $address;
		$this->coordinates = $coordinates;
	}

}