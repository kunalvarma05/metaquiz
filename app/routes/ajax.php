<?php
/**
 * AJAX Routes
 * Routes for AJAX Requests
 */
Route::group(array('before' => 'ajax', 'prefix' => "ajax"), function() {
	/**
	 * Get Users Friends
	 */
	Route::get('user/friends', array('before' => "auth", 'uses' => "AuthController@getFriends"));
	/**
	 * Get User Info
	 */
	Route::get('user_info/{id}', array('before' => "auth", 'uses' => "AuthController@getInfo"));
});
