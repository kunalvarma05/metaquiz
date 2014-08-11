<?php
/**
 * Activated Routes
 * Require the user's account to be activated
 */
Route::group(array('before' => 'activated'), function() {
	/**
	 * Base Route
	 * The Base Route
	 */
	Route::get('/', array('uses' => "RoutesController@baseRoute"));

	/**
	 * AJAX Routes
	 * Routes for AJAX Requests
	 */
	if (Request::ajax()) {
		require_once app_path() . "/routes/ajax.php";
	}

	/**
	 * Authentication Routes
	 * Routes that handle the authentication views and logic
	 */
	require_once app_path() . "/routes/authentication.php";

	/**
	 * Auth Routes
	 * These routes require the user to be logged in
	 */
	require_once app_path() . "/routes/auth.php";
});
/**
 * Account Activation Form
 */
Route::get('activate', array('as' => "activate", 'before' => "auth", 'uses' => "RoutesController@activateRoute"));

/**
 * Handle Account Activation Form Data
 */
Route::post('activate', array('as' => "activate-account", 'before' => "auth|csrf", 'uses' => "UsersController@activate"));