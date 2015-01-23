<?php
/**
 * Dashboard Routes
 */

/**
 * The Index Page
 */
Route::get('/', array('as' => 'app', 'uses' => "DashboardController@index"));

/**
 * The Home Page
 */
Route::get('home', array('as' => "app.home", 'uses' => "DashboardController@home"));
