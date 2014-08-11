<?php
/**
 * Admin Routes
 * These routes require the user to be an Admin
 */
Route::group(array('before' => "auth", 'prefix' => "admin"), function() {
	/**
	 * Home Route
	 * The Home Page
	 */
	Route::get('admin', array('as' => "admin", 'uses' => "AdminsController@dashboard"));

	/**
	 * Courses Route
	 * The Courses Route
	 */
	Route::get('courses', array('as' => "admin-courses", 'uses' => "CoursesController@index"));
});
