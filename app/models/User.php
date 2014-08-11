<?php

use Zizaco\Entrust\HasRole;
use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

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
	 * Organization
	 * The Organization the user belongs to
	 * @return Organization Collection
	 */
	public function organization() {
		return $this -> belongsTo('Organization');
	}
	
	/**
	 * Accountable
	 * The Account Type of the user
	 * @return Collection
	 */
	public function accountable(){
        return $this->morphTo();
    }

	
	/**
	 * Quizes
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
	 * Challenges
	 * All the challenges the user has been challenged for
	 * @return Challenges Collection
	 */
	public function challenges(){
		return $this->belongsToMany('Challenge');		
	}
	
	/**
	 * Challenged
	 * All the challenges the user has challenged others for
	 * @return Challenges Collection
	 */
	public function challenged(){
		return $this->hasMany('Challenge', 'challenger_id');		
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
	 * Activation
	 * The Activation Statistic of the user
	 */
	 public function activation(){
		return $this->hasOne('Activation');
	 }
	 
	 /**
	  * Friends
	  * The friends of the current user
	  */
	  public function friends(){
	  	return $this->hasMany('Friend','friend_one')->where('status', '=', 1);
	  }
}
