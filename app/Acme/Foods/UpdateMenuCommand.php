<?php  namespace Acme\Foods; 

class UpdateMenuCommand {

	public $id;
	public $name;
	public $type;
	public $price;
	public $details;

	function __construct($id, $name, $type, $price, $details)
	{
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->price = $price;
		$this->details = $details;
	}


} 