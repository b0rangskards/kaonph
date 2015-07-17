<?php  namespace Acme\Foods; 

use Acme\Base\BaseRepositoryInterface;
use Food;

class FoodRepository implements BaseRepositoryInterface {

	public function save(Food $food)
	{
		return $food->save();
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