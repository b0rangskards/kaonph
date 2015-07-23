<?php  namespace Acme\Forms; 

use Food;
use Input;
use Laracasts\Validation\FormValidationException;
use Laracasts\Validation\FormValidator;

class UpdateMenuForm extends FormValidator {

	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [

		'id'         => 'required|numeric|exists:foods,id',
		'name'       => "required|min:3",
		'type'       => 'required|exists:food_types,id',
		'restaurant' => 'required|exists:restaurants,id',
		'price'      => 'required|numeric',
		'picture'    => 'mimes:jpeg,png'

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

		$food = Food::find($formData['id']);

		$findFood = Food::whereName($formData['name']);
		if($findFood) {
			if($findFood->first()->name != $food->name){
				throw new FormValidationException('Validation failed', [ 'name' => ['The name is already taken.']]);
			}
		}

		return true;
	}

} 