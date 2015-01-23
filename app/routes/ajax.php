<?php
/**
 * AJAX Routes
 * Routes for AJAX Requests
 */
Route::group(array('before' => 'ajax|csrf', 'prefix' => "ajax"), function() {
	/**
	 * Get Users Friends
	 */
	Route::post('user/friends', array('before' => "auth", 'uses' => "AuthController@getFriends", 'as' => "ajax.user.friends"));
	/**
	 * Get User Info
	 */
	Route::post('user_info/{id}', array('before' => "auth", 'uses' => "AuthController@getInfo", 'as' => "ajax.user.info"));
});
