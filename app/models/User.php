<?php

use Zizaco\Entrust\HasRole;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
/**
 * The User Class
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * Traits
	 */
	use UserTrait, RemindableTrait, HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Fillable
	 */
	protected $fillable = array('name','email','username','password', 'accountable_id', 'accountable_type', 'organization_id','picture', 'password_set');

	 /**
	  * Guarded
	  */
	 protected $guarded = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//Remember Me
	public function getRememberToken(){
		return $this->remember_token;
	}

	public function setRememberToken($value){
		$this->remember_token = $value;
	}

	public function getRememberTokenName(){
		return 'remember_token';
	}


	//----------------Relationships----------------//

	/**
	 * The Organization the user belongs to
	 * @return Organization Collection
	 */
	public function organization() {
		return $this -> belongsTo('Organization');
	}

	/**
	 * The Account Type of the user
	 * @return Collection
	 */
	public function accountable(){
		return $this->morphTo();
	}


	/**
	 * All the quizes the user has participated in
	 * @return Quiz Collection
	 */
	public function quizes() {
		return $this -> belongsToMany('Quiz');
	}

	/**
	 * Achievements
	 * All the achievements the user has unlocked
	 * @return Achievement Collection
	 */
	public function achievements() {
		return $this -> belongsToMany('Achievement');
	}

	/**
	 * Answers
	 * All the answers the user has given
	 * @return Answer Collection
	 */
	public function answers(){
		return $this->hasMany('Answer', 'user_id');
	}

	/**
	 * Notifications
	 * All the notifications that belong to the user
	 * @return Notifications Collection
	 */
	public function notifications(){
		return $this->hasMany('Notification');
	}

	/**
	 * All the challenges the user is a part of
	 * @return Challenges Collection
	 */
	public function challenges(){
		return $this->belongsToMany('Challenge');
	}


	/**
	 * Stat
	 * All the stats of the user
	 * @return Stat Collection
	 */
	public function stat() {
		return $this -> hasOne('Stat');
	}

	/**
	 * Friends of the user
	 * @return Eloquent Relationship
	 */
	public function friends(){
		return $this->belongsToMany('User', 'friends', 'user_id', 'friend_id');
	}
}
