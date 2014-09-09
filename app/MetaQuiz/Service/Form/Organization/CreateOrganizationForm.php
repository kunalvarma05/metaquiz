<?php
namespace MetaQuiz\Service\Form\Organization;

use MetaQuiz\Repositories\Organization\OrganizationInterface;

class CreateOrganizationForm {
	/**
	 * Form Data
	 * @var Array
	 */
	protected $data;

	/**
	 * Validator
	 * @var \MetaQuiz\Servie\Validation\ValidableInterface
	 */
	protected $validator;

	/**
	 * Organization Repository
	 * @var \MetaQuiz\Repo\Organization\OrganizationInterface
	 */
	protected $organization;

	/**
	 * Constructor
	 */
	public function __construct(CreateOrganizationFormValidator $validator, OrganizationInterface $organization) {
		$this -> validator = $validator;
		$this -> organization = $organization;
	}

	/**
	 * Create a new Organization
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function create(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$input['picture'] = uploadProfilePic($input['picture'], 'organization');
		return $this -> organization -> create($input);
	}

	/**
	 * Validation Errors
	 * @return array
	 */
	public function errors() {
		return $this -> validator -> errors();
	}

	/**
	 * Test if form validator passes
	 */
	public function valid(array $input) {
		return $this -> validator -> with($input) -> passes();
	}

}
