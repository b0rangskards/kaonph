<?php  namespace Acme\Restaurants; 

use Acme\Base\BaseRepositoryInterface;
use Restaurant;

class RestaurantRepository implements BaseRepositoryInterface {

	public function save(Restaurant $restaurant)
	{
		return $restaurant->save();
	}

	public function getTableData()
	{
		// TODO: Implement getTableData() method.
	}

	public function getTableColumns()
	{
		// TODO: Implement getTableColumns() method.
	}
}