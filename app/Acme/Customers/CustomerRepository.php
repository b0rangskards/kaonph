<?php  namespace Acme\Customers; 

use Acme\Base\BaseRepositoryInterface;
use Customer;

class CustomerRepository implements BaseRepositoryInterface {

	public function save(Customer $customer)
	{
		return $customer->save();
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