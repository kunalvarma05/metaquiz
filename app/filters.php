<?php

/*
 |--------------------------------------------------------------------------
 | Application & Route Filters
 |--------------------------------------------------------------------------
 |
 | Below you will find the "before" and "after" events for the application
 | which may be used to do any work before or after a request into your
 | application. Here you may also register your custom route filters.
 |
 */

 App::before(function($request) {
	//
 });

 App::after(function($request, $response) {
	//
 });

/*
 |--------------------------------------------------------------------------
 | Authentication Filters
 |--------------------------------------------------------------------------
 |
 | The following filters are used to verify that the user of the current
 | session is logged into this application. The "basic" filter easily
 | integrates HTTP Basic authentication for quick, simple checking.
 |
 */

 Route::filter('auth', function() {
 	if (Auth::guest()) {
 		if (Request::ajax()) {
 			return Response::make('Unauthorized', 401);
 		} else {
 			return Redirect::guest('/');
 		}
 	}
 });

 Route::filter('auth.basic', function() {
 	return Auth::basic();
 });

/*
 |--------------------------------------------------------------------------
 | Guest Filter
 |--------------------------------------------------------------------------
 |
 | The "guest" filter is the counterpart of the authentication filters as
 | it simply checks that the current user is not logged in. A redirect
 | response will be issued if they are, which you may freely change.
 |
 */

 Route::filter('guest', function() {
 	if (Auth::check())
 		return Redirect::to('login');
 });

/*
 |--------------------------------------------------------------------------
 | CSRF Protection Filter
 |--------------------------------------------------------------------------
 |
 | The CSRF filter is responsible for protecting your application against
 | cross-site request forgery attacks. If this special token in a user
 | session does not match the one given in this request, we'll bail.
 |
 */

 Route::filter('csrf', function() {
 	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
 	if (Session::token() != $token)
 		throw new Illuminate\Session\TokenMismatchException;
 });

/*
 |--------------------------------------------------------------------------
 | Account Activation Filter
 |--------------------------------------------------------------------------
 |
 | The CSRF filter is responsible for protecting your application against
 | cross-site request forgery attacks. If this special token in a user
 | session does not match the one given in this request, we'll bail.
 |
 */
 Route::filter('activated', function() {
 	if (Auth::check()) {
 		if (!Auth::user() -> is_activated) {
 			return Redirect::to(URL::route('activate'));
 		}
 	}
 });

/**
 * Redirect user to homepage if already activated
 */
Route::filter('not-activated', function() {
	if (Auth::check()) {
		if (Auth::user() -> is_activated) {
			return Redirect::to('/');
		}
	}
});

/**
 * Apply CSRF to all POST requests
 */
Route::when('*', 'csrf', array('post'));

/**
 * Ajax Filter
 * Aborts the request if the route isn't accessed through an AJAX Call
 */
Route::filter('ajax', function() {
	if (!Request::ajax()) {
		return App::abort('404');
	}
});

/**
 * Has Password
 * Redirects the user to set a password, if already not set
 */
Route::filter('has-password', function() {
	if (Auth::check()) {
		if (!Auth::user() -> password_set) {
			return Redirect::to(URL::route('set-password'));
		}
	}
});

/**
 * No Password
 * Redirects the user if password is set
 */
Route::filter('no-password', function() {
	if (Auth::user() -> password_set) {
		return Redirect::to('/');
	}
});

/**
 * Admin Route Filer
 */
Route::filter("admin_role", function(){
	if (! Entrust::hasRole('Admin') ) // Checks the current user
	{
		App::abort(404);
	}
});

/**
 * Management Route Filer
 */
Route::filter("manager_role", function(){
	if (! Entrust::hasRole('Manager') ) // Checks the current user
	{
		App::abort(404);
	}
});

/**
 * Faculty Route Filer
 */
Route::filter("faculty_role", function(){
	if (! Entrust::hasRole('Faculty') ) // Checks the current user
	{
		App::abort(404);
	}
});

/**
 * Student Route Filer
 */
Route::filter("student_role", function(){
	if (! Entrust::hasRole('Student') ) // Checks the current user
	{
		App::abort(404);
	}
});
