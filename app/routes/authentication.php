<?php
/**
 * Authentication Routes
 * Routes that handle the authentication views and logic
 */

/**
 * Facebook Connect
 */
Route::get('login/{id?}', array('as' => "login", 'before' => "guest", 'uses' => "RoutesController@facebookRoute"));

/**
 * Handle the data from Facebook Connect Callback
 */
Route::get('connect', array('as' => "connect", "uses" => "UsersController@connect"));
