<?php
namespace MetaQuiz\Repositories\Activation;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use MetaQuiz\Repositories\User\UserInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentActivation extends AbstractEloquentRepository implements ActivationInterface {

	//The Model object
	protected $model;

	//The Cache Object
	protected $cache;

	//The User Object
	protected $user;

	//The Constructor
	public function __construct(Model $model, UserInterface $user, CacheInterface $cache) {
		//Set the object
		$this -> model = $model;
		$this -> user = $user;
		$this -> cache = $cache;
	}

	/**
	 * Activate
	 * Activate a user account
	 *
	 * @param integer $user_id
	 * @param array $code
	 */
	public function activate($user_id, $code) {
		//Find the Activation
		$activation = $this -> getFirstBy('code', $code);
		//If the activation is found
		if ($activation) {
			//Find the User
			$user = $this -> user -> byID($user_id);
			//If the user is found
			if ($user) {
				//find the associated account with the activation
				$account = $activation -> activable() -> first();
				//associate the user with the corresponding organization
				$user -> organization_id = $activation -> organization_id;
				//set the user as activated
				$user -> is_activated = true;
				//Save the user along with it's associated account type
				$save = $account -> profile() -> save($user);
				if($save){
					$activation->delete();
				}
				return $save;
			} else {
				//If the user is not found
				return false;
			}
		} else {
			//If the activation is not found
			return false;
		}
	}

	/**
	 * Create an Activation record
	 * @param  array  $input Input Data
	 * @return Mixed
	 */
	public function create(array $input) {
		//Create the model
		$activation = $this -> model -> create($input);
		//Return the activation
		return $activation;
	}

}
