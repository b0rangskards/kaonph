<?php  namespace Acme\Presenters; 

use Laracasts\Presenter\Presenter;

class FoodPresenter extends Presenter {

	public function prettyName()
	{
		return ucwords($this->name);
	}

	public function prettyPrice()
	{
		return 'PHP '.$this->price;
	}

	public function prettyDetails()
	{
		return ucwords($this->details);
	}
} 