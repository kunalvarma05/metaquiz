<?php
/**
 * Activated Routes
 * Require the user's account to be activated
 */
Route::group(array('before' => 'activated'), function() {
	/**
	 * AJAX Routes
	 */
	Route::group(array('before' => 'ajax', 'prefix' => "ajax"), function() {
		/**
		 * Get Users Friends
		 */
		Route::get('user/friends', array('before' => "auth", 'uses' => "UsersController@getFriends"));
		/**
		 * Get User Info
		 */
		Route::get('user_info/{id}', array('before' => "auth", 'uses' => "UsersController@getInfo"));
	});

	/**
	 * Base Route
	 */
	Route::get('/', array('uses' => "RoutesController@baseRoute"));

	/**
	 * Facebook Connect
	 */
	Route::get('login/{id?}', array('as' => "login", 'before' => "guest", 'uses' => "RoutesController@facebookRoute"));

	/**
	 * Handle the data from Facebook Connect Callback
	 */
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
		/**
		 * Home Route
		 */
		Route::get('home', array('as' => "home", 'uses' => "HomeController@home"));
		/**
		 * Logout
		 */
		Route::get('logout', array('as' => "logout", 'before' => "auth", 'uses' => "RoutesController@logoutRoute"));
	});
});
/**
 * Account Activation Form
 */
Route::get('activate', array('as' => "activate", 'before' => "auth", 'uses' => "RoutesController@activateRoute"));

/**
 * Handle Account Activation Form Data
 */
Route::post('activate', array('as' => "activate-account", 'before' => "auth|csrf", 'uses' => "UsersController@activate"));

/**
 * Organizations Resource
 */
Route::resource('organization', 'OrganizationsController', array('names' => array('create' => 'organization-apply')));
