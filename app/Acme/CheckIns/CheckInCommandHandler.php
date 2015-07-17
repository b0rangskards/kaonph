<?php  namespace Acme\CheckIns; 

use Acme\Customers\CustomerRepository;
use Auth;
use Carbon\Carbon;
use Customer;
use Laracasts\Commander\CommandHandler;
use Log;

class CheckInCommandHandler implements CommandHandler {

	protected $repository;

	function __construct(CustomerRepository $repository)
	{
		$this->repository = $repository;
	}


	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$user_id = Auth::user()->id;
		$date_visited = Carbon::now();

		$customer = Customer::checkIn(
			$user_id,
			$command->restaurant_id,
			$date_visited,
			$command->rating
		);

		$this->repository->save($customer);

		Log::info($customer);

		return $customer;
	}
}