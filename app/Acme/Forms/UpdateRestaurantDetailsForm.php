<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidationException;
use Laracasts\Validation\FormValidator;
use Log;
use Restaurant;

class UpdateRestaurantDetailsForm extends FormValidator {

	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [

		'id'          => 'required|exists:restaurants,id',
		'name'        => 'required|min:3|company_name',
		'address'     => 'required|min:5',
		'type'        => 'required',
		'contact_no'  => 'required',
		'logo'        => 'mimes:jpeg,png',
		'coordinates' => 'required'

	];

	public function validate($formData)
	{
		$formData = $this->normalizeFormData($formData);
		$this->validation = $this->validator->make(
			$formData,
			$this->getValidationRules(),
			$this->getValidationMessages()
		);

		if ( $this->validation->fails() ) {
			throw new FormValidationException('Validation failed', $this->getValidationErrors());
		}

		$restaurant = Restaurant::find($formData['id']);

		$findRestaurant = Restaurant::whereName(strtolower($formData['name']))->get();

		if ( !$findRestaurant->isEmpty() ) {
			if ( $findRestaurant->first()->name != $restaurant->name ) {
				throw new FormValidationException('Validation failed', ['name' => ['The name is already taken.']]);
			}
		}

		return true;
	}
} 