<?php
namespace MetaQuiz\Repositories\User;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Repositories\Activity\ActivityInterface;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;
use Redirect;
use Activity;

class EloquentUser extends AbstractEloquentRepository implements UserInterface {

	//The user object
	protected $model;

	//The Cache Object
	protected $cache;

	//The Activity Object
	protected $activity;

	//Class Dependency: Eloquent Model
	public function __construct(Model $model, ActivityInterface $activity, CacheInterface $cache) {
		//Set the objects
		$this -> model = $model;
		$this -> cache = $cache;
		$this -> activity = $activity;
	}

	/**
	 * All
	 * Get all the users
	 * @param array $with
	 * @return User Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('users.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$users = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $users);
		//And return
		return $users;
	}

	/**
	 * byUsername
	 * Get a Single user by Username
	 * @param string Username of the user
	 * @return object Object of user information
	 */
	public function byUsername($username, $with = array()) {
		//Generate the key
		$key = md5('user.username.' . $username);
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$user = $this -> getFirstBy('username', $username, $with);
		//Store Cache
		$this -> cache -> put($key, $user);
		//And return
		return $user;
	}

	/**
	 * The Activity feed of a given user
	 * @param  int $id The UserID
	 */
	public function feed($id) {
		$feed = $this->activity->whereIn('user_id', function($query) use ($id) {
			$query->select('friend_id')
			->from('friends')
			->where('user_id', $id)->where('status','=','accepted');
		})->orWhere('user_id', $id)->get();
		return $feed;
	}

	/**
	 * Get the friends of the user
	 * @param  int $id   UserID
	 * @param  array $with Related Models
	 */
	public function getFriends($id, array $with = array()){
		return $this->requireByID($id, $with)->friends()->where('status','accepted')->get();
	}

	/**
	 * Create
	 * Create a User
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input) {
		//Create the model
		$user = $this -> model -> create($input);
		//Return the user
		return $user;
	}

}
