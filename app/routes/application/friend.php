<?php
/**
 * Friend Routes
 */

/**
 * The Friends Page
 */
Route::get('friends', array('as' => "app.friends", 'uses' => "FriendsController@index"));

/**
 * Add Friend
 */
Route::any('friends/add', array('as' => "app.friends.add", 'uses' => "FriendsController@store"));