<?php
/**
 * Faculty Routes
 */
Route::group(array('prefix' => "faculty", 'before' => "auth|faculty_role|has-password|activated"), function() {
	/**
	 * The Index Page
	 */
	Route::get('/', array('as' => "faculty", 'uses' => "FacultyController@index"));

	/**
	 * The Dashboard
	 */
	Route::get('dashboard', array('as' => "faculty.dashboard", 'uses' => "FacultyController@dashboard"));
});
