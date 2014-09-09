<?php
namespace MetaQuiz\Service\Form\Organization;

use MetaQuiz\Repositories\Organization\OrganizationInterface;

class UpdateOrganizationForm {
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
	public function __construct(UpdateOrganizationFormValidator $validator, OrganizationInterface $organization) {
		$this -> validator = $validator;
		$this -> organization = $organization;
	}

	/**
	 * Update an Organization
	 * @param integer ID of the organization
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$org = $this -> organization -> byID($id);
		if ($org) {
			if ($input['picture']) {
				if ($org -> picture) {
					deleteProfilePic($org -> picture, "organization");
				}
				$input['picture'] = uploadProfilePic($input['picture'], 'organization');
			}
			return $org -> update($input);
		}
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
