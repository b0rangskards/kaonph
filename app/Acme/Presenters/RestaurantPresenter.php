<?php  namespace Acme\Presenters; 

use Laracasts\Presenter\Presenter;

class RestaurantPresenter extends Presenter {

	public function prettyName()
	{
		return ucwords($this->name);
	}

	public function prettyType()
	{
		return ucwords($this->type);
	}

	public function prettyAddress()
	{
		return ucwords($this->address);
	}
} 