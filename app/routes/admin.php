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
	Route::get('/', array('as' => "admin", 'uses' => "AdminsController@dashboard"));
});
