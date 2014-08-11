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
		return Redirect::to('/');
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
	if (Session::token() != Input::get('_token')) {
		throw new Illuminate\Session\TokenMismatchException;
	}
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
			return Redirect::to('activate');
		}
	}
});

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
 * Admin
 * Checks whether the logged in user is Admin of an Organization
 */
Entrust::routeNeedsRole('/admin/*', 'Admin');

/**
 * Teacher
 * Checks whether the logged in user is a Teacher of an Organization
 */
Entrust::routeNeedsRole('/faculty/*', 'Teacher');

/**
 * Student
 * Checks whether the logged in user is a Student of an Organization
 */
Entrust::routeNeedsRole('/app/*', 'Student');
