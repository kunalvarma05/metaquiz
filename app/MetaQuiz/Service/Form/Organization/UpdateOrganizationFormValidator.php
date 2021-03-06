<?php
namespace MetaQuiz\Service\Form\Organization;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateOrganizationFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required", "description" => "required", 'picture' => "image|max:300");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array('picture.max' => "The picture should be less than 300kb.");

}
