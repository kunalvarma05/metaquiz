<?php
/**
* Challenge Routes
*/
Route::group(array('prefix' => "challenges", 'before' => "auth|has-password|activated"), function() {

	/**
	 * All Challenges
	 */
	Route::get('/', array('as' => "app.challenges", 'uses' => "ChallengeController@index") );

	/**
	 * Create Challenge
	 */
	Route::post('create', array('as' => "app.challenges.create", 'uses' => "ChallengeController@create"));

	/**
	 * Single Challenge Page
	 */
	Route::get('{id}', array('as' => "app.challenges.show", 'uses' => "ChallengeController@show"));

	/**
	 * Accept Challenge
	 */
	Route::post('accept', array('as' => "app.challenges.accept", 'uses' => "ChallengeController@accept"));

	/**
	 * Reject Challenge
	 */
	Route::post('reject', array('as' => "app.challenges.reject", 'uses' => "ChallengeController@reject"));

});