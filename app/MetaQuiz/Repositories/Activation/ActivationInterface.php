<?php
namespace MetaQuiz\Repositories\Activation;

interface ActivationInterface {

	/**
	 * Activate an Account
	 * @param  Integer $id   The ID of the user
	 * @param  String $code The Activation Code
	 * @return Mixed|Boolean
	 */
	public function activate($user_id, $code);

	/**
	 * Create an Activation record
	 * @param  array  $input Input Data
	 * @return Mixed
	 */
	public function create(array $input);

}
