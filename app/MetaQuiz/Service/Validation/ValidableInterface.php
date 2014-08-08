<?php
namespace MetaQuiz\Service\Validation;

interface ValidableInterface {
	/**
	 * Add data to validation
	 * @param array Input to be validated
	 * @return \MetaQuiz\Service\Validation\ValidableInterface
	 */
	public function with(array $input);

	/**
	 * Test if validation passes
	 * @return bool
	 */
	public function passes();

	/**
	 * Retrive validation errors
	 * @return array Array of errors
	 */
	public function errors();	
}
