<?php
Route::get('chat', array('before' => "auth", function() {
	return View::make('chat');
}));
Route::group(array('before' => 'activated'), function() {
	/**
	 * AJAX Routes
	 */
	Route::group(array('before' => 'ajax', 'prefix' => "ajax"), function() {
		//Get user's friends
		Route::get('user/friends', array('before' => "auth", function() {
			$user = Auth::user();
			$key = md5("user_friends_info_" . $user -> id);
			if (!Cache::has($key)) {
				$friends = $user -> friends() -> get() -> toArray();
				Cache::add($key, $friends, 60);
			}
			return array_fetch(Cache::get($key), 'friend_two');
		}));
		//Get user info
		Route::get('user_info/{id}', array('before' => "auth", function($id) {
			$key = md5("user_info_" . $id);
			if (!Cache::has($key)) {
				$user = User::findOrFail($id);
				Cache::add($key, $user, 60);
			}
			return Cache::get($key);
		}));
	});

	//Base Route
	Route::get('/', function() {
		if (Auth::check()) {
			return Redirect::to('home');
		} else {
			return View::make('splash');
		}
	});
	//Facebook Connect/Login
	Route::get('login/{id?}', array('as' => "login", 'before' => "guest", function($id = null) {
		//Only for testing, to be moved inside a controller for production
		if (isset($id) && !empty($id)) {
			$user = User::findOrFail($id);
			Auth::login($user);
			return Redirect::to('/');
		} else {
			return Redirect::to(Facebook::getLoginUrl());
		}
	}));
	//Handle the Data fetched from facebook
	Route::get('connect', array('as' => "connect", "uses" => "UsersController@connect"));
	/**
	 * Auth Routes
	 * These routes require the user to be logged in
	 */
	Route::group(array('before' => "auth"), function() {
		/**
		 * Subjects Route
		 */
		Route::get('subjects', array('as' => "subjects", "uses" => "SubjectsController@index"));
		//Home Route
		Route::get('home', array('as' => "home", function() {
			return View::make('app.home.index');
		}));
		//Logout
		Route::get('logout', array('as' => "logout", 'before' => "auth", function() {
			Auth::logout();
			return Redirect::to('/');
		}));
	});
});
//Activation Route
Route::get('activate', array('as' => "activate", 'before' => "auth", function() {
	if (Auth::user() -> is_activated) {
		return Redirect::to('/');
	}
	return View::make('activate-account');
}));
//Handle Account Activation Form
Route::post('activate', array('as' => "activate-account", 'before' => "auth|csrf", 'uses' => "UsersController@activate"));
