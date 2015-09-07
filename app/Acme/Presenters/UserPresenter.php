<?php  namespace Acme\Presenters; 

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

	public function fullName()
	{
		return ucwords($this->firstname . ' ' . $this->lastname);
	}

} 