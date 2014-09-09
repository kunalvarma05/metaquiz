<?php
/**
 * Authentication Routes
 * Routes that handle the authentication views and logic
 */

/**
 * Facebook Connect
 */
Route::get('facebook/auth', array('as' => "facebook-connect", 'before' => "guest", 'uses' => "RoutesController@facebookRoute"));

/**
 * Handle the data from Facebook Connect Callback
 */
Route::get('connect', array('as' => "connect", "uses" => "UsersController@connect", 'before' => "guest"));

/**
 * Signup Form
 */
Route::get('signup', array('as' => "signup", "uses" => "UsersController@create", 'before' => "guest"));

/**
 * Handle Signup Form Data
 */
Route::post('signup/post', array('as' => "signup/post", "uses" => "UsersController@store", 'before' => "guest"));

/**
 * Login Form
 */
Route::get('login', array('as' => "login", "uses" => "UsersController@login", 'before' => "guest"));

/**
 * Handle Login Form Data
 */
Route::post('login/post', array('as' => "login/post", "uses" => "UsersController@doLogin", 'before' => "guest"));

/**
 * Account Activation Form
 */
Route::get('activate', array('as' => "activate", "uses" => "ActivationController@form", 'before' => "auth|has-password|not-activated"));

/**
 * Handle Activation Form Data
 */
Route::post('activate/post', array('as' => "activate/post", "uses" => "ActivationController@activate", 'before' => "auth|has-password|not-activated"));

/**
 * Set Password
 * Ask the user to set a password, if haven't done already
 */
Route::get('set/password', array('as' => "set-password", 'uses' => "UsersController@setPassword", 'before' => "auth|no-password"));

/**
 * Store Password
 * Handle the password set form
 */
Route::post('set/password/save', array('as' => "store-password", 'uses' => "UsersController@storePassword", 'before' => "auth|no-password"));

/**
 * Logout
 * The Logout URL
 */
Route::get('logout', array('as' => "logout", 'before' => "auth", 'uses' => "RoutesController@logoutRoute"));
