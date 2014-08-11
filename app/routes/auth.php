<?php
/**
 * Auth Routes
 * These routes require the user to be logged in
 */
Route::group(array('before' => "auth"), function() {
	/**
	 * Home Route
	 * The Home Page
	 */
	Route::get('home', array('as' => "home", 'uses' => "ApplicationsController@homePage"));
	/**
	 * Subjects Route
	 * The Subjects Page
	 */
	Route::get('subjects', array('as' => "subjects", "uses" => "ApplicationsController@subjectsPage"));
	/**
	 * Logout
	 * The Logout URL
	 */
	Route::get('logout', array('as' => "logout", 'before' => "auth", 'uses' => "RoutesController@logoutRoute"));
});
