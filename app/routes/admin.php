<?php
/**
 * Admin Routes
 */
Route::group(array('prefix' => "admin", 'before' => "auth|admin_role|has-password|activated"), function() {
	/**
	 * The Index Page
	 */
	Route::get('/', array('as' => "admin", 'uses' => "AdminsController@dashboard"));

	/**
	 * Organizations
	 */
	Route::resource('organizations', "AdminOrganizationsController");

	/**
	 * Organization Courses
	 */
	Route::resource('organizations.courses', "AdminCoursesController");
});
