<?php
namespace MetaQuiz\Repositories\Activation;

use MetaQuiz\Repositories\RepositoryInterface;

interface ActivationInterface extends RepositoryInterface {

	/**
	 * Activate an Account
	 * @param  Integer $id   The ID of the user
	 * @param  String $code The Activation Code
	 * @return Mixed|Boolean
	 */
	public function activate($user_id, $code);

}
