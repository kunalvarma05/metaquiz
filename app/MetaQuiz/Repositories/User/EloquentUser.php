<?php
namespace MetaQuiz\Repositories\User;

use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;
use Redirect;

class EloquentUser implements UserInterface {

	//The user object
	protected $user;

	//The Cache Object
	protected $cache;

	//Class Dependency: Eloquent Model
	public function __construct(Model $user, CacheInterface $cache) {
		//Set the object
		$this -> user = $user;
		$this -> cache = $cache;
	}

	/**
	 * All
	 * Get All the Users
	 * @return object Object of the users information
	 */
	public function all() {
		return $this -> user -> all();
	}

	/**
	 * byUsername
	 * Get a Single user by Username
	 * @param string Username of the user
	 * @return object Object of user information
	 */
	public function byUsername($username) {
		//Generate the key
		$key = md5('username.' . $username);
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$user = $this -> user -> where('username', $username) -> firstOrFail();
		//Store Cache
		$this -> cache -> put($key, $user);
		//And return
		return $user;
	}

	/**
	 * getFriends
	 * Get a the friends of the user
	 * @param Integer ID of the user
	 * @return object Object of user information
	 */
	public function getFriends($id) {
		$user = $this -> user -> find($id);
		$key = md5("user_friends_info_" . $user -> id);
		if (!$this -> cache -> has($key)) {
			$friends = $user -> friends() -> get() -> toArray();
			$this -> cache -> put($key, $friends, 60);
		}
		return array_fetch($this -> cache -> get($key), 'friend_two');
	}

	/**
	 * getInfo
	 * Get a the info of the given user
	 * @param Integer ID of the user
	 * @return object Object of user information
	 */
	public function getInfo($id) {
		$key = md5("user_info_" . $id);
		if (!$this -> cache -> has($key)) {
			$user = $this -> user -> findOrFail($id);
			$this -> cache -> put($key, $user, 60);
		}
		return $this -> cache -> get($key);
	}

	/**
	 * byID
	 * Get a Single user by ID
	 * @param Integer ID of the user
	 * @return object Object of user information
	 */

	public function byID($id) {
		//Generate the key
		$key = md5('id.' . $id);
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		$user = $this -> user -> findOrFail($id);
		//Store Cache
		$this -> cache -> put($key, $user);
		return $user;
	}

	/**
	 * Create
	 * Create a User
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input) {
		$user = $this -> user -> create($input);
		if (!$user) {
			return false;
		}
		return true;
	}

	/**
	 * Activate
	 * Activate a User
	 * @param Integer $id
	 * @param String $code
	 */
	public function activate($id, $code) {
		$user = $this -> user -> find($id);
		$activation = $user -> activation() -> where('code', '=', $code) -> first();
		if ($activation) {
			$user -> is_activated = true;
			if ($user -> save()) {
				return true;
			} else {
				return false;
			}
		} else {
			return Redirect::back() -> with('error', "The entered code is incorrect!");
		}
	}

}
