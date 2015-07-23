<?php  namespace Acme\Forms; 

use Laracasts\Validation\FormValidationException;
use Laracasts\Validation\FormValidator;
use Restaurant;

class AddMenuToRestaurantForm extends FormValidator {

	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [

		'name'          => 'required|min:3',
		'type'          => 'required|exists:food_types,id',
		'restaurant'    => 'required|exists:restaurants,id',
		'price'         => 'required|numeric',
		'picture'       => 'mimes:jpeg,png'

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

		//check if restaurant has already a specialy
		if(isset($formData['is_specialty']) && $formData['is_specialty'] === 'on')
		{
			if( Restaurant::hasFoodSpecialty($formData['restaurant'])) {
				throw new FormValidationException('Validation failed', ['error' => "Restaurant has already a food specialty.\n You can change it anyway."]);
			}
		}


		return true;
	}
} 