<?php

Route::group(array('prefix' => "app", 'before' => "auth|student_role|has-password|activated"), function() {
	/**
	 * The Index Page
	 */
	Route::get('/', array('as' => 'app', 'uses' => "ApplicationsController@index"));

	/**
	 * The Home Page
	 */
	Route::get('home', array('as' => "app.home", 'uses' => "ApplicationsController@home"));

	/**
	 * The Subjects Page
	 */
	Route::get('subjects', array('as' => "app.subjects", 'uses' => "ApplicationsController@subjects"));

	/**
	 * The Friends Page
	 */
	Route::get('friends', array('as' => "app.friends", 'uses' => "ApplicationsController@friends"));
});